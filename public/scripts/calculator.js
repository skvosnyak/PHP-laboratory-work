const viewField = document.querySelector(".showInput");
const calculator = document.querySelectorAll(".buttonCalc");
let calcWindow = "";

calculator.forEach((button) => {
    button.addEventListener("click", async (e) => {
        const id = e.target.id;

        if (id === "C") {
            calcWindow = "";
            viewField.innerHTML = "0";
        }
        else if (id === "=") {
            await calculateExpression(calcWindow);
        }
        else {
            calcWindow += id;
            viewField.innerHTML = calcWindow;
        }
    });
});

async function calculateExpression(expression) {
    try {
        const response = await fetch('/calculate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ expression: expression })
        });

        const data = await response.json();

        if (data.success) {
            viewField.innerHTML = data.result;
            calcWindow = data.result.toString();
        } else {
            viewField.innerHTML = 'Ошибка: ' + data.error;
            setTimeout(() => {
                viewField.innerHTML = "";
                calcWindow = "";
            }, 2000);
        }
    } catch (error) {
        console.error('Ошибка:', error);
        viewField.innerHTML = 'Ошибка соединения';
    }
}
