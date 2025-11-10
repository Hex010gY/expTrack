document.querySelectorAll('.dropdown-item').forEach(item => {
  item.addEventListener('click', function (e) {
    e.preventDefault();
    const value = this.getAttribute('data-value');
    const icon = this.querySelector('i').outerHTML;
    const button = this.closest('.dropdown').querySelector('.dropdown-toggle');
    const hiddenInput = this.closest('form').querySelector('input[type="hidden"]');
    button.innerHTML = `${icon} ${value}`;
    hiddenInput.value = value;
  });
});