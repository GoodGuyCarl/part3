<script>
	/**
	 * This script listens for changes on form inputs and select elements.
	 * When a change is detected, it sends an AJAX POST request to the 'filter' endpoint with the form data.
	 * On successful response, it updates the table body with the response HTML and updates the count of assignments in the h1 element.
	 *
	 * @requires jQuery
	 */
    $(document).ready(function() {
        /**
         * Event handler for change events on form inputs and select elements.
         * Sends an AJAX POST request to the 'filter' endpoint with the form data.
         */
        $('form input, form select').on('change', function() {
            var formData = $('form').serialize();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('filter') ?>',
                data: formData,
                success: function(response) {
                    // Update the table body with the response HTML
                    $('tbody').html(response);
                    // Update the count of assignments in the h1 element
                    $('h1 span').text($('tbody tr').length);
                    if($('tbody tr').length == 1)
                        $('h1').text($('tbody tr').length + ' Assignment');
                    else
                        $('h1').text($('tbody tr').length + ' Assignments');
                }
            });
        });
    });
</script>
<main class="container mx-auto my-5">
    <form class="d-flex gap-5 align-items-center">
        <h1><span><?= $rows ?></span> Assignments</h1>
        <div class="d-flex align-items-center gap-2">
            <?php foreach($levels as $level): ?>
                <input type="checkbox" name="level[]" value="<?= $level['level'] ?>" id="<?= $level['level'] ?>" />
                <label for="<?= $level['level'] ?>"><?= $level['level'] ?></label>
            <?php endforeach; ?>
            <select name="track" class="form-select">
				<option selected disabled><< select a track >></option>
                <?php foreach($tracks as $track): ?>
                    <option value="<?= $track['track'] ?>"><?= $track['track'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Assignment</th>
                <th>Sequence num</th>
                <th>Level</th>
                <th>Track</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): ?>
                <tr>
                    <td><?= $assignment['assignment'] ?></td>
                    <td><?= $assignment['sequence_number'] ?></td>
                    <td><?= $assignment['level'] ?></td>
                    <td><?= $assignment['track'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
