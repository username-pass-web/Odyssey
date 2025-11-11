document.addEventListener('DOMContentLoaded', function() {
    const optionLabels = document.querySelectorAll('.quiz-options label');
    const firstRadio = document.querySelector('.quiz-options input[type="radio"]');

    // Si los radios están deshabilitados, significa que ya se respondió.
    const isAnswered = firstRadio && firstRadio.disabled;

    if (!isAnswered) {
        optionLabels.forEach(label => {
            label.addEventListener('click', function() {
                // No hacer nada si ya está deshabilitado
                if (this.querySelector('input[type="radio"]').disabled) {
                    return;
                }

                document.querySelectorAll('.quiz-option').forEach(option => {
                    option.classList.remove('quiz-option--selected');
                });
                
                const selectedOption = this.querySelector('.quiz-option');
                if (selectedOption) {
                    selectedOption.classList.add('quiz-option--selected');
                }
                
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });
    } else {
        // Si la pregunta ya fue respondida, marcar visualmente la opción seleccionada
        const checkedRadio = document.querySelector('.quiz-options input[type="radio"]:checked');
        if (checkedRadio) {
            const selectedOption = checkedRadio.closest('label').querySelector('.quiz-option');
            if (selectedOption) {
                selectedOption.classList.add('quiz-option--selected');
            }
        }
    }
});