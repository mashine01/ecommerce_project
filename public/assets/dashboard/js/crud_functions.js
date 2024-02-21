function checkCheckbox() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const selectedCheckbox = Array.from(checkboxes).map(cb => cb.checked ? cb.value : '').filter(Boolean);
    return selectedCheckbox;
}

function deleteSelected(route) {
    const selectedCheckbox = checkCheckbox();
    if (selectedCheckbox.length > 0) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = route + encodeURIComponent(JSON.stringify(selectedCheckbox));
        deleteForm.submit();
    } else {
        alert('Please select an item to delete');
    }
}
