<section id="contactUs" onClick="hideItem('menu');">
    <div class="myContainer">
        <div class="row text-center">
            <div class="col-12 col-md-6 titleSessionTesto">
                <h1><b>Contattaci</b></h1>
                <br>
            </div>
		</div>
		<form action="../utils/emailAdmin.php" method="POST">
	        <div class="row text-center">
    	        <div class="col-12 col-md-6">
        	        <textarea id="myTextArea" rows=15 name="textEmail"></textarea> 
            	</div>
	        </div>
        
    	    <div class="row text-center">
        	    <div class="col-12 col-md-6">
            	    <input type="submit" class="btn btn-primary mt-2" id="btnContatUs" value="INVIA"/>
	            </div> 
    	    </div>
		</form>
    </div>
</section>
