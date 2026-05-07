<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $expression = $request->input('expression');

        if (empty($expression)) {
            return response()->json([
                'success' => false,
                'error' => 'Поле expression не может быть пустым'
            ]);
        }

        try {
            if (!preg_match('/^[0-9+\-*\/\(\)\s\.sin|cos|tan|tg|cot|ctg]+$/i', $expression)) {
            }

            $result = $this->evaluateExpression($expression);

            return response()->json([
                'success' => true,
                'result' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    private function evaluateTrigonometric($funcName, $degrees)
    {
        $radians = deg2rad($degrees);
        $funcName = strtolower($funcName);

        switch ($funcName) {
            case 'sin':
                return sin($radians);
            case 'cos':
                return cos($radians);
            case 'tan':
            case 'tg':
                return tan($radians);
            case 'cot':
            case 'ctg':
                $result = cos($radians) / sin($radians);
                return $result;
            default:
                throw new \Exception("Неизвестная функция: $funcName");
        }
    }

    private function evaluateExpression($expr)
    {
        $expr = str_replace(' ', '', $expr);

        if ($expr === '') {
            throw new \Exception('Пустое выражение');
        }


        if (preg_match('/^(sin|cos|tan|tg|cot|ctg)\((\d+(?:\.\d+)?)\)$/i', $expr, $matches)) {
            $funcName = $matches[1];
            $degrees = (float)$matches[2];
            return $this->evaluateTrigonometric($funcName, $degrees);
        }


        while (preg_match('/(sin|cos|tan|tg|cot|ctg)\((\d+(?:\.\d+)?)\)/i', $expr, $matches)) {
            $funcName = $matches[1];
            $degrees = (float)$matches[2];
            $value = $this->evaluateTrigonometric($funcName, $degrees);
            $expr = str_replace($matches[0], $value, $expr);
        }

        if (substr($expr, 0, 1) === '-') {
            if (is_numeric($expr)) {
                return (float)$expr;
            }
            return $this->evaluateExpression('0' . $expr);
        }

        if (is_numeric($expr)) {
            return (float)$expr;
        }

        while (($lastOpen = strrpos($expr, '(')) !== false) {
            $firstClose = strpos($expr, ')', $lastOpen);
            if ($firstClose === false) {
                throw new \Exception('Незакрытая скобка');
            }

            $inner = substr($expr, $lastOpen + 1, $firstClose - $lastOpen - 1);
            $innerResult = $this->evaluateExpression($inner);
            $expr = substr($expr, 0, $lastOpen) . $innerResult . substr($expr, $firstClose + 1);
        }

        $pos = $this->findOperator($expr, '+');
        if ($pos !== false) {
            $left = $this->evaluateExpression(substr($expr, 0, $pos));
            $right = $this->evaluateExpression(substr($expr, $pos + 1));
            return $left + $right;
        }

        $pos = $this->findSubtractionOperator($expr);
        if ($pos !== false) {
            $left = $this->evaluateExpression(substr($expr, 0, $pos));
            $right = $this->evaluateExpression(substr($expr, $pos + 1));
            return $left - $right;
        }

        $pos = $this->findOperator($expr, '*');
        if ($pos !== false) {
            $left = $this->evaluateExpression(substr($expr, 0, $pos));
            $right = $this->evaluateExpression(substr($expr, $pos + 1));
            return $left * $right;
        }

        $pos = $this->findOperator($expr, '/');
        if ($pos !== false) {
            $left = $this->evaluateExpression(substr($expr, 0, $pos));
            $right = $this->evaluateExpression(substr($expr, $pos + 1));
            if ($right == 0) {
                throw new \Exception('Деление на ноль');
            }
            return $left / $right;
        }

        throw new \Exception('Неверное выражение');
    }

    private function findSubtractionOperator($expr)
    {
        $length = strlen($expr);
        for ($i = $length - 1; $i >= 0; $i--) {
            if ($expr[$i] === '-') {
                if ($i === 0 || $this->isOperator($expr[$i - 1]) || $expr[$i - 1] === '(') {
                    continue;
                }
                return $i;
            }
        }
        return false;
    }

    private function findOperator($expr, $operator)
    {
        $length = strlen($expr);
        for ($i = $length - 1; $i >= 0; $i--) {
            if ($expr[$i] === $operator) {
                return $i;
            }
        }
        return false;
    }

    private function isOperator($char)
    {
        return in_array($char, ['+', '-', '*', '/']);
    }
}
