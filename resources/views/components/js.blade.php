<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.js" crossorigin="anonymous"></script>
<!-- Nepcha Analytics (nepcha.com) -->
<!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
{{-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>



<!--   Core JS Files   -->
{{-- <script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script> --}}
<script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

<!-- SweetAlert2 JS -->

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
{{-- <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script> --}}
<script src="{{ asset('/assets/js/soft-ui-dashboard.min.js') }}"></script>

<script>
  $(document).ready(function() {
    $('#myTable').DataTable({
        "columnDefs": [
          // { "className": "dt-center", "targets": "_all" }
        ]
    });
    // $('#myTable thead th').addClass('dt-center');
  });
</script>