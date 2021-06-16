<style>
    .myAlert-bottom{
      position: fixed;
      bottom: 5px;
      left:20%!important;
      right:20%!important;
      right:auto;
      width: auto;
      z-index: 2;
    }
    @media (max-width: 992px) {
      .myAlert-bottom{

      left:5%!important;
      right:5%!important;
      right:auto;
      width: auto;
      z-index: 2;
    }
    }
</style>
<script>
    $(document).ready(function () {
    setTimeout(function(){
        jQuery(".myAlert-bottom").fadeOut('slow');
  }, 5000);
});
</script>

@if ($message = Session::get('success_msg'))
<div class="myAlert-bottom mx-auto alert text-white font-weight-light rounded-10" style="background-color: #00c853">
<a href="#" class="close d-inline text-light" data-dismiss="alert" aria-label="close">&times;</a>
  <i class='bx bx-check-circle h6 mr-2' style='font-size:18px;' > </i>{{ $message }}
</div>
@endif


@if ($message = Session::get('error_msg'))
<div class="myAlert-bottom mx-auto alert text-white font-weight-light rounded-10" style="background-color:#f44336;">
  <a href="#" class="close d-inline text-light text-center" data-dismiss="alert" aria-label="close">&times;</a>
    <i class='bx bxs-error-circle h6 mr-2' style='font-size:18px;' > </i>{{ $message }}
</div>
@endif

