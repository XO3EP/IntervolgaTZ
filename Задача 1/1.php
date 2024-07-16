<!DOCTYPE html>
<?php
echo "<h3>Задача №1</h3>";
$data = [
	['Иванов', 'Математика', 5],
	['Иванов', 'Математика', 4],
	['Иванов', 'Математика', 5],
	['Петров', 'Математика', 5],
	['Сидоров', 'Физика', 4],
	['Иванов', 'Физика', 4],
	['Петров', 'ОБЖ', 4],
];
$last_names = [];
$studys_names = [];
for($i=0;$i<=count($data)-1;$i++)
{
    array_push($last_names, $data[$i][0]);
    array_push($studys_names, $data[$i][1]);
}
$last_names = array_unique($last_names);
sort($last_names);
$studys_names = array_unique($studys_names);
sort($studys_names);

echo "<table border style='border-collapse:collapse;width:500px;text-align:center'>";
echo "<tr> <td> </td> <td> Математика </td> <td> ОБЖ </td> <td> Физика </td> </tr>";
for($i=0;$i<=count($last_names)-1;$i++)
{
    echo "<tr>";
    echo "<td>" . $last_names[$i] . "</td>";
    for($j=0;$j<=count($studys_names)-1;$j++)
    {
        $point = 0;
        for($n=0;$n<=count($data)-1;$n++)
        {
            if($last_names[$i] == $data[$n][0]&&$studys_names[$j] == $data[$n][1])
            {
                $point+=$data[$n][2];
            }
        }
        if($point!=0)
        {
            echo "<td>" . $point . "</td>";
        }
        else
            echo "<td>" . "" . "</td>";
    }
    
    echo "</tr>";
}
echo "</table>";
?>
