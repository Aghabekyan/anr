		<footer>
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
							<div class="footer-menu">
								<a href="<?= createURL('rooms') ?>"><?= $t['header']['rooms'] ?></a>
								<a href="<?= createURL('reservation') ?>"><?= $t['header']['reservation'] ?></a>
								<a href="<?= createURL('static=1') ?>"><?= $t['header']['services'] ?></a>
								<a href="<?= createURL('static=3') ?>"><?= $t['header']['conferences'] ?></a>
								<a href="<?= createURL('static=4') ?>"><?= $t['header']['bar'] ?></a>
								<a href="<?= createURL('contacts') ?>"><?= $t['header']['contacts'] ?></a>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
							<div class="socail-icons footer-socials">
								<a href="https://www.facebook.com/diamondhousehotel/?fref=ts" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>	
								<a href="" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>	
								<a href="https://www.linkedin.com/company/diamond-house-hotel-yerevan" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>	
								<a href="https://www.tripadvisor.com/Hotel_Review-g293932-d6839245-Reviews-Diamond_House-Yerevan.html" target="_blank"><img src="./img/trip_logo.svg" alt=""></a>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<p><?= $t['footer']['copy'] ?></p>
							<a style="color: #E1BD85; font-size: 12px;" target="_blank" href="http://ghazaryan.pro">Website By</a>							
						</div>
					</div>
				</div>
			</div>	
		</footer>
		<!-- jQuery first, then Tether, then Bootstrap JS. -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
		<script src="js/vendor.js?v=0.1"></script>
		<script src="js/main.js?v=0.1"></script>
	</body>
</html>