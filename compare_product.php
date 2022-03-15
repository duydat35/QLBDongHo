<?php 
include_once './admin/config.php';

$compareID = $_POST['ID'];

$sql = "SELECT * FROM sanpham WHERE MaSP=".$compareID;
  $result_set=mysqli_query($con, $sql);
  if(mysqli_num_rows($result_set)>0)
  {
    while($row=mysqli_fetch_array($result_set))
    {
?>
<li class="compare_product">
    <div class="compare_proudct-close "><i class="fas fa-times"></i></div>
    <div class="compare_proudct-main">
      <img class="compare_proudct-img" src="./image/<?=$row['AnhSP']?>">
      <h6 class="compare_proudct-name text-center"><?=$row['TenSP']?></h6>
    </div>
    
    <!-- <button class="the" data-id='<?php echo $compareID; ?>'> ádfadfssdfsd <?php echo $compareID; ?></button>
    <?php echo $compareID; ?> -->
</li>

<?php 
    }
  }
?>


<script>    
$(document).ready(function(){
  
  $('.compare_proudct-close ').click(function(){
    quanitySpace=3;
    $(this).parents('.compare_product').remove();
  });

  $('#btn-compare').click(function(){
    var pro1 = $('#product_one').val();
    var pro2 = $('#product_two').val();
    var pro3 = $('#product_three').val();
  if(pro1 == '')
  {
    $('#product_one').val(<?php echo $compareID ?>);
  }
  else if(pro2 == '')
  {
    $('#product_two').val(<?php echo $compareID ?>);
  }
  else if(pro3 == '')
  {
    $('#product_three').val(<?php echo $compareID ?>);
  }
  });
});
</script>