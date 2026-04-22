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
                'error' => 'Введите выражение'
            ]);
        }

        try {
            if (!preg_match('/^[0-9+\-*\/\(\)\s]+$/', $expression)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Недопустимые символы'
                ]);
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


    private function evaluateExpression($expr)
    {
        $expr = str_replace(' ', '', $expr);

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

        $pos = strrpos($expr, '+');
        if ($pos !== false) {
            $left = $this->evaluateExpression(substr($expr, 0, $pos));
            $right = $this->evaluateExpression(substr($expr, $pos + 1));
            return $left + $right;
        }

        $pos = strrpos($expr, '-');
        if ($pos !== false && $pos > 0) {
            $left = $this->evaluateExpression(substr($expr, 0, $pos));
            $right = $this->evaluateExpression(substr($expr, $pos + 1));
            return $left - $right;
        }

        $pos = strrpos($expr, '*');
        if ($pos !== false) {
            $left = $this->evaluateExpression(substr($expr, 0, $pos));
            $right = $this->evaluateExpression(substr($expr, $pos + 1));
            return $left * $right;
        }

        $pos = strrpos($expr, '/');
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
}
