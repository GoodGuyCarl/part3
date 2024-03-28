<?php foreach ($assignments as $assignment): ?>
    <tr>
        <td><?= $assignment['assignment'] ?></td>
        <td><?= $assignment['sequence_number'] ?></td>
        <td><?= $assignment['level'] ?></td>
        <td><?= $assignment['track'] ?></td>
    </tr>
<?php endforeach; ?>
