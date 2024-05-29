document.addEventListener("DOMContentLoaded", function() {
    var dashboardType = localStorage.getItem('dashboardType');
    if (dashboardType === 'voter') {
        document.getElementById('backButton').href = 'voters_dashboard.html';
    } else if (dashboardType === 'candidate') {
        document.getElementById('backButton').href = 'candidate_dashboard.html';
    }
});
