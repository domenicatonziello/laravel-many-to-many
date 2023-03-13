// prendo elementi dal DOM
const buttons = document.querySelectorAll('.delete-form');
buttons.forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const hasConfirmed = confirm('Sei sicuro di voler eliminare?');
        if (hasConfirmed) form.submit();
    });
});