<table>
    <tr>
        <?php foreach ($data['headers'] as $header): ?>
            <th><?php print $header; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($data['data'] as $row_index => $row): ?>
        <tr>
            <?php foreach ($row as $col_index => $col): ?>
                    <td><?php print $col; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>