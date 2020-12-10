<? require($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php"); ?>
<div class="wrap" style="background:#ECEFF3">
<div class="container">
	<form action="">
		<h1>Material Design formular</h1> 
		
		<!-- select -->
		<div class="form-group">
			<select name="name">
				<option value="">Test</option>	
				<option value="">Test 2</option>
			</select>	
			<label for="select" class="control-label">Selectbox</label> 
			<i class="bar"></i>
		</div>	
		
		<!-- input -->
		<div class="form-group">
			<input type="text" required="">
			<label for="input" class="control-label">Textfield</label> 
			<i class="bar"></i>
		</div>	
	
		<!-- textarea -->
		<div class="form-group">
			<textarea name="" id="" cols="30" rows="10" required=""></textarea>
			<label for="textarea" class="control-label">Textarea</label>
			<i class="bar"></i>
		</div>	
		
		<!-- checkbox -->
		<div class="checkbox">
			<label>
				<input type="checkbox" checked="">
				<i class="helper"></i>
				I'm the label from a checkbox
			</label>
		</div>		
		<div class="checkbox">
			<label>
				<input type="checkbox">
				<i class="helper"></i>
				I'm the label from a checkbox
			</label>
		</div>	

		<!-- radio -->	
		<div class="form-radio">
			<div class="radio">
				<label>
					<input type="radio" name="radio" checked="">
					<i class="helper"></i>
					I'm the label from a radio button
				</label>
				</div>	
			<div class="radio">
				<label>
					<input type="radio" name="radio">
					<i class="helper"></i>
					I'm the label from a radio button
				</label>
			</div>		
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<i class="helper"></i>
					I'm the label from a checkbox
				</label>	
			</div>		
		</div>	

		<!-- button -->	
		<div class="button-container">
			<button class="button" type="button"><span>Submit</span></button>
		</div>	
	</form>	
</div>
</div>