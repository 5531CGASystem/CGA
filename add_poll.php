<?php
// Author: 40196855
// Tester: 40186828

include('includes/head.php');
// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
	// Redirect user back to previous page
	header("location: discussion_board.php");
	exit;
}
?>
<div class=content>
<button><a href="discussion_board.php">Back</a></button>
    <p></p>
	<br />
	<div class="col-md-6">
		<form name="addPoll" method="POST" action="includes/do_add_poll.php" role="form">
			<div class="form-group">
				<div>
					<label for="question">Poll Question: <font color='red'> *</font></label>
				</div>
				<div>
					<textarea type="text" class="form-control" name="question" id="question" value="" wrap=virtual required rows=10 cols=40></textarea>
				</div>
			</div>
			

			<div class="form-group options" id="options">
				<label for="exampleInputEmail1">Options: </label>
				<div>
					<input type="text" class="form-control input-block" name="option[]" value="" required />
				</div>
				<div>
					<input type="text" class="form-control input-block" name="option[]" value="" required />
				</div>
			</div>
			<div class="form-group">
				<button class="btn btn-default" type="button" onclick="addOption()">Add More Options</button>
			</div>

			<div>

				<p><strong>End date:</strong>
					<font color='red'> *</font><br>
					<input type='date' name='due_date' required>
				</p>
			</div>
			<div>
				<p><strong>Voters:</strong>
					<font color='red'> *</font><br>
					<select name="category" required>
						<option selected disabled value="">Please choose an option</option>
						<?php
						// Display categories available to post to for admin, instructor, and TA
						if ($_SESSION['role_id'] < 4) {
							$data = $link->query("SELECT category_id, name FROM forum_categories WHERE marked_entity_id=" . $_SESSION['entity_id']);
							if ($data->num_rows > 0) {
								while ($row = mysqli_fetch_array($data, MYSQLI_NUM)) {
									// Display the categories available
									$cat_id = $row[0];
									$cat_name = $row[1];
									echo "<option value='" . $cat_id . "'>" . $cat_name . "</option>";
								}
							}
						}
						// Display categories available to post to for students
						else {
							// Get the groups that the student belong to
							$groups = ['all'];
							$data = $link->query("SELECT group_id FROM group_users WHERE user_id=" . $_SESSION['id'] . " AND left_group_date is null");
							if ($data->num_rows > 0) {
								while ($row = mysqli_fetch_array($data, MYSQLI_NUM)) {
									array_push($groups, (string)$row[0]);
								}
							}

							// Display the discussion boards available
							foreach ($groups as $value) {
								$data = $link->query("SELECT * FROM forum_categories WHERE (viewable_to LIKE '%," . $value . ",%') AND marked_entity_id=" . $_SESSION['entity_id']);
								if ($data->num_rows > 0) {
									while ($row = mysqli_fetch_array($data, MYSQLI_NUM)) {
										$cat_id = $row[0];
										$cat_name = $row[2];
										echo "<option value='" . $cat_id . "'>" . $cat_name . "</option>";
									}
								}
							}
						}
						?>
					</select>



			</div>

			<div>
				<button class="btn btn-primary" type="submit" name="savePoll">Add Poll</button>
			</div>
		</form>
	</div>

	</body>

	</html>