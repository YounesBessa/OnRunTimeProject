<footer>
        	<div class="divform">
        		<form class="formulaire" action="" method="post">

				<div class="flexform">
        			<div class="form_text form_general">
        				<input placeholder="Votre nom" id="nom" type="text" name="nom" value="<?php if (!empty($_POST['nom'])) {echo $_POST['nom'];} ?>">
        				<span class="error"><?php if (!empty($errors['nom'])) {echo $errors['nom'];} ?></span>
        			</div>

        			<div class="form_text form_general">
        				<input placeholder="Votre prénom" id="prenom" type="text" name="prenom" value="<?php if (!empty($_POST['prenom'])) {echo $_POST['prenom'];} ?>">
        				<span class="error"><?php if (!empty($errors['prenom'])) {echo $errors['prenom'];} ?></span>
					</div>

				</div>

        			<div class="form_text form_general">
        				<input placeholder="Votre e-mail" id="email" type="text" name="email" value="<?php if (!empty($_POST['email'])) {echo $_POST['email'];} ?>">
						<span class="error"><?php if (!empty($errors['email'])) {echo $errors['email'];} ?></span>					
        			</div>

        			<div class="form_message form_general">
        				<textarea placeholder="Votre message" id="message" name="message"><?php if (!empty($_POST['message'])) {echo $_POST['message'];} ?></textarea>
        				<span class="error"><?php if (!empty($errors['message'])) {echo $errors['message'];} ?></span>
        			</div>

        			<div class="form_submit form_general">
        				<input type="submit" name="submitted" value="Envoyer">
        				<span class="succes"><?php if (!empty($errors['submitted'])) {echo $errors['submitted'];} ?></span>
        			</div>

        		</form>
        	</div>
        	<div class="divform">
        		<p>Notre Agence de Sydney<br><br>26 Lavender St, Sydney Nord<br><br>Ouvert 7j/7 de 09h à 13h et de 14h à 20h<br><br>+61 49 78 21 33<br><br>contact@ort.com</p>
        	</div>
			<div class="divform">
				<img src="assets/img/sydney.jpg" />
			</div>
        	


        	<!-- script -->
        	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        	<script src="assets/js/main.js"></script>
        </footer>
        </body>

        </html>