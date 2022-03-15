<?php
include_once 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="chart.css" type="text/css">
    <link rel="stylesheet" href="index.css" type="text/css">

    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Home</title>
   

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tên sản phẩm', 'Số lượng'],
          <?php
          $sql = "SELECT ctdathang.MaSP, sanpham.TenSP, SUM(SoLuong) AS soluong, SUM(ThanhTien)
          AS doanhthu FROM ctdathang,sanpham WHERE sanpham.MaSP=ctdathang.MaSP GROUP BY MaSP ORDER BY doanhthu DESC limit 5";
          $fire = mysqli_query($con,$sql);
          $tongDoanhThu = "SELECT  sanpham.TenSP, SUM(ThanhTien) AS doanhthu FROM ctdathang,sanpham WHERE sanpham.MaSP=ctdathang.MaSP ";
          $resultTongDoanThu = mysqli_fetch_array(mysqli_query($con,$tongDoanhThu))['doanhthu'];
          while ($result = mysqli_fetch_assoc($fire)) {
            
            echo "['".$result['TenSP']."',".$result['doanhthu']."]," ;
            $resultTongDoanThu -= $result['doanhthu'];
          }
          echo "['Còn lại',". $resultTongDoanThu."],"
          ?>
        ]);

        var options = {
          title: 'Tỉ trọng doanh thu sản phẩm',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <div class="container">
      <div class="main__title mb-3 rounded">
              Biểu đồ thống kê
      </div>
        <div class="main__content main__edit shadow bg-white rounded " style="overflow: hidden; padding: 10px 50px 30px !important" >
        <div class="chart_ctn" style="border-bottom: none;">
            <div class="bestSalePrt">
                <div class="chart" style="display: flex;">
                  <canvas id="doughnutchart" style="max-width:60%" class=" top-chart-left" ></canvas >
                  <div id="piechart_3d" class="top-chart-right" ></div>
                </div>
                <canvas id="barchart" style="max-width:900px"></canvas>
            </div>
        </div>
      
         
          
    </div>
    <script>
      <?php 
      $sql = "SELECT sanpham.TenSP, SUM(SoLuong) AS SoLuong FROM ctdathang,sanpham 
      WHERE sanpham.MaSP=ctdathang.MaSP GROUP BY sanpham.MaSP ORDER BY soluong DESC limit 4";
      $sqlTotalQuanity = "SELECT sanpham.TenSP, SUM(SoLuong) AS SoLuong FROM ctdathang,sanpham 
      WHERE sanpham.MaSP=ctdathang.MaSP";
      $totalQuanity = mysqli_fetch_array(mysqli_query($con,$sqlTotalQuanity))['SoLuong'];
      $result = mysqli_query($con,$sql);
      $arrName= array();
		  $arrQuanity=array();
		  $arrColor=array(); // mảng lưu trữ color
      while ($row = mysqli_fetch_array($result)) 
      {
        $randomColor = "#".substr(md5(rand()), 0, 6);// random color with md5 function
			  array_push($arrName,$row['TenSP']);
			  array_push($arrQuanity,$row['SoLuong']);
			  array_push($arrColor,$randomColor);
        $totalQuanity -= $row['SoLuong'];
      } 
      array_push($arrName,'Còn lại');
			array_push($arrQuanity,$totalQuanity);
			array_push($arrColor,"#".substr(md5(rand()), 0, 6));
      ?>
      var xValues=<?php echo json_encode($arrName); ?>;
      var yValues=<?php echo json_encode($arrQuanity); ?>;
      var barColors=<?php echo json_encode($arrColor); ?>;

      new Chart("doughnutchart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        title: {
          display: true,
          text: "Sản phẩm bán chạy"
        }
      }
      });
</script>


<script >
		<?php
		$sql="SELECT ThoiGianDat,SUM(TongTien) AS DoanhThu FROM dathang GROUP BY ThoiGianDat ORDER BY ThoiGianDat DESC LIMIT 7";
		$resultSet=mysqli_query($con,$sql);
		$arrDate= array();
		$arrTotalMoney=array();
		$arrColor=array(); 
		while($rows=mysqli_fetch_assoc($resultSet))
		{
			$rand_color = "#".substr(md5(rand()), 0, 6);
			array_push($arrDate,date("d-m-Y",strtotime($rows['ThoiGianDat'])));
			array_push($arrTotalMoney,$rows['DoanhThu']);
			array_push($arrColor,$rand_color);
		}
		?>
		var xValues=<?php echo json_encode($arrDate); ?>;
		var yValues=<?php echo json_encode($arrTotalMoney); ?>;
		var barColors=<?php echo json_encode($arrColor); ?>; 

		new Chart("barchart", {
		type: "bar",
		data: {
			labels: xValues,
			datasets: [{
			backgroundColor: barColors,
			data: yValues
			}]
		},
		options: {
			legend: {display: false},
			title: {
			display: true,
			text: "Doanh thu gần đây"
			}
		}
		});
	</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
