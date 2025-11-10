const alert = document.querySelector('.alert');
  if (alert) {
    setTimeout(() => {
      const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
      bsAlert.close();
    }, 4000);
  }