<?php require_once 'includes/header.php'; ?>

<?php 

$sql = "SELECT * FROM product ";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM product where quantity > warning AND quantity > 0 ";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$countWarning = "SELECT * FROM product where quantity <= warning";
$WarningSql = $connect->query($countWarning);
$countWarnings = $WarningSql->num_rows;

$lowStockSql = "SELECT * FROM product WHERE  quantity = 0";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;
 

//$connect->close();

?>


<div class="row">
	<div class="col-md-3">
		<div class="panel panel-info">
			<div class="panel-heading">			
				<a href="product.php" style="text-decoration:none;color:black;">
					จำนวนสินค้าทั้งหมด
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
		<div class="col-md-3">
			<div class="panel panel-success">
			<div class="panel-heading">
				<a href="productAVB.php" style="text-decoration:none;color:black;">
					Available
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->
		

		<div class="col-md-3">
			<div class="panel panel-warning">
			<div class="panel-heading">
				<a href="productWN.php" style="text-decoration:none;color:black;">
					Warning
					<span class="badge pull pull-right"><?php echo $countWarnings; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	<div class="col-md-3">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="productNAVB.php" style="text-decoration:none;color:black;">
					No Available
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->	
</div>
<?php
$product = "SELECT product.product_image,product.product_name,sum(sell_item.quantity) FROM product,sell_item,sell WHERE product.product_id = sell_item.product_id AND sell.sell_id = sell_item.sell_id AND MONTH(sell.sell_date) = MONTH(NOW())-1 group by product.product_name order by sum(sell_item.quantity) desc limit 3";
$result = $connect->query($product); 
//$imageUrl = substr($row["product_image"], 3);
?>
	<div style="height:75px;"><h1 align="center">สินค้ายอดนิยมประจำเดือน <?php echo (date("n")-1) ?></h1></div>
<div class="container" style="width: 800px;">
	<div id="product_loading">
	<?php
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
	?>
	<div class="col-md-4">  
							
                     <div style="background-color: #D7D2D0; border:1px solid #CCC; padding:12px; margin-bottom:16px; height:375px;" align="center" >  
                          <img src="<?php echo substr($row["product_image"],1);?>" class="img-responsive" />  
                          <h3>ชื่อสินค้า : <?php echo $row["product_name"]; ?></h3>  
						  <h3>จำนวนที่ขายได้ : <?php echo $row["sum(sell_item.quantity)"]; ?></h3>
                     </div>  
                </div>
	<?php			
		}
	}	
	?>
	</div>
</div>


<?php require_once 'includes/footer.php'; ?>