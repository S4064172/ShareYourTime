<div class="modal fade" id="evalModal" tabindex="-1" role="dialog" aria-labelledby="evalModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="container myContainer-padding">
						<div class="row">
							<div class="container">
								<h2>Come valuteresti questo lavoro ?</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 offset-md-3">
								<!-- mettiamo le stelline per valutare -->
								<form id="ratingsForm" action="../modalView/checkEval.php" method="POST">
							 		<div class="stars">
										<input type="radio" name="star" class="star-1" id="star-1" value="1">
											<label class="star-1" for="star-1">1</label>
										<input type="radio" name="star" class="star-2" id="star-2" value="2">
											<label class="star-2" for="star-2">2</label>
										<input type="radio" name="star" class="star-3" id="star-3" value="3">
											<label class="star-3" for="star-3">3</label>
										<input type="radio" name="star" class="star-4" id="star-4" value="4">
											<label class="star-4" for="star-4">4</label>
										<input type="radio" name="star" class="star-5" id="star-5" value="5">
											<label class="star-5" for="star-5">5</label>
										<span></span>
									</div>
									<br>	
									<div>
										<input type="submit" value="Ok"></input>
									</div>
								</form>
							</div>
						</div>
					<div>
    	   				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
