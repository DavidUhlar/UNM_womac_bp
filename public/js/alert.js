function showAndHideAlert(alertId) {
    var alert = document.getElementById(alertId);
    if (alert) {
        alert.classList.add('show');
        setTimeout(function() {
            alert.style.opacity = 0;
            setTimeout(function() {
                alert.style.display = 'none';
            }, 300);
        }, 3000);
    }
}

window.onload = function() {
    showAndHideAlert('error-alert');
    showAndHideAlert('success-alert');
};
