<h1>Profile Editor</h1>
<span class="smText">Pictures can be added/modified once "Add Athlete" is clicked</span>
<table cellpadding="1" cellspacing="1" border="0" id="editor">
            <tr>
             <td align="left" valign="top">Firstname:</td>
             <td>&nbsp;</td>
             <td><input type="text" name="val_input[0][firstname]" value="<?php echo "$firstname"; ?>"></td>
            </tr>
            <tr>
              <td align="left" valign="top">Lastname:</td>
              <td>&nbsp;</td>
              <td><input type="text" name="val_input[0][lastname]" value="<?php echo "$lastname"; ?>"></td>
            <tr> 
              <td align="left" valign="top">Team:</td>
              <td>&nbsp;</td>
              <td><select name="val_input[0][team]">
<?           
	$sql = "SELECT sport, id FROM sports ORDER BY sport ASC";
	$result = mysql_query($sql, $conn);
	while ($value = mysql_fetch_array($result)) {
		$sport = $value['sport'];
		$sid = $value['id'];
		echo "                 <option value=\"$sid\"";
		if ($sid == $team) { 
			echo " selected";
		} 
			echo ">$sport</option>\n";
	}     
?>
              </select></td>
            </tr> 
            <tr>
              <td align="left" valign="top">Position/Event:</td>
              <td>&nbsp;</td>
              <td><input type="text" name="val_input[0][pos_event]" value="<?php echo "$pos_event"; ?>"></td>
            </tr>
            <tr>        
              <td align="left" valign="top">Years:</td>
              <td>&nbsp;</td>
              <td><input type="text" name="val_input[0][years]" value="<?php echo "$years"; ?>"></td>
            </tr>
            <tr>
              <td align="left" valign="top">High School:</td>
              <td>&nbsp;</td>
              <td><input type="text" name="val_input[0][highschool]" value="<?php echo "$highschool"; ?>"></td>
            </tr>
            <tr>
              <td align="left" valign="top">All American:</td>
              <td>&nbsp;</td>
              <td><select name="val_input[0][aa]">
                  <option value="0" <?php if ($aa == "0") { echo "selected"; } ?>>No</option>
                  <option value="1" <?php if ($aa == "1") { echo "selected"; } ?>>Yes</option></td>
            </tr>
            <tr>
              <td align="left" valign="top">Hall of Fame:</td>
              <td>&nbsp;</td>
              <td><select name="val_input[0][hof]">
                  <option value="0" <?php if ($hof == "0") { echo "selected"; } ?>>No</option>
                  <option value="1" <?php if ($hof == "1") { echo "selected"; } ?>>Yes</option></td>
            </tr>
            <tr>
              <td align="left" valign="top">Academic All American:</td>
              <td>&nbsp;</td>
              <td><select name="val_input[0][aaa]">
                  <option value="0" <?php if ($aaa == "0") { echo "selected"; } ?>>No</option>
                  <option value="1" <?php if ($aaa == "1") { echo "selected"; } ?>>Yes</option></td>
            </tr>
            <tr>
              <td align="left" valign="top">Story:</td>
              <td>&nbsp;</td>
              <td><textarea name="val_input[0][story]"><?php echo "$story"; ?></textarea></td>
            </tr>
            <tr>
              <td align="left" valign="top">Bests:</td>
              <td>&nbsp;</td>
              <td><textarea name="val_input[0][bests]"><?php echo "$bests"; ?></textarea></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td align="right"><a href="<?php echo $_SERVER[PHP_SELF]; ?>">Return Home Without Saving</a> <input type=submit name="val_input[0][menu]" value="Save"> <input type=submit name="val_input[0][photo]" value="Save & Continue to Photo"></td>
            </tr>
        </table>
        </form>
