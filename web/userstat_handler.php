<?
class UserComicStat 
{
function __construct() {
	}
function __destruct() {
	}
function countBasedOnGenre($subscriber_id, $genre) {
		$query = "select count(distinct(c.title)) as count from rent_history a, book b, book_title c where subscriber_id='".$subscriber_id."' and a.book_id=b.book_id and b.code=c.code and c.genre='".$genre."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
function writeHeader($fb) {
		$genre_list = array(
			'Adventure Fantasy',
			'Drama',
			'Romance',
			'Action',
			'Comedy',
			'History',
			'Detective',
			'Mystery',
			'Sport',
			'Unspecified'
		);
		$i = 0;
		foreach ($genre_list as &$value ) {
			$c[$i] = $this->countBasedOnGenre($fb->subscriber_id, $value);
			$i++;
		}
		$total = 0;
		for ( $i = 0; $i < count($c); $i++ ) {
			$total += $c[$i];
		}
		for ( $i = 0; $i < count($c); $i++ ) {
			$res[$i] = ((float)$c[$i]/(float)$total)*100;
		}
		echo "<script type=\"text/javascript\" src=\"jquery.min.js\"></script>
		<script type=\"text/javascript\">
$(function () {
        $('#userstat').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Statistik Komposisi Genre Anda'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Anggota airabooks',";
                echo "data:[";
					for ( $i = 0; $i < count($res); $i++ ) {
						echo "['".$genre_list[$i]."',".$res[$i]."],";
					}
				echo "]";
				/*data: [
                    ['Laki - Laki',   ".$maleper."],
                    {
                        name: 'Perempuan',
                        y: ".$femaleper.",
                        sliced: true,
                        selected: true
                    }
                ]*/
				echo
				"
            }]
        });
    });
    

		</script>
		";
	}
}


?>

<?
class UserVisitStat 
{
function __construct() {
	}
function __destruct() {
	}
function countBasedOnDay($subscriber_id, $day) {
		$query = "select count(*) as count from rent_history where subscriber_id='".$subscriber_id."' and DATE_FORMAT(rent_date, '%W')='".$day."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
function writeHeader($fb) {
		$day_list = array(
			'Senin' => 'Monday',
			'Selasa' => 'Tuesday',
			'Rabu' => 'Wednesday',
			'Kamis' => 'Thursday',
			'Jumat' => 'Friday',
			'Sabtu' => 'Saturday',
			'Minggu' => 'Sunday'
		);
		$i = 0;
		foreach ($day_list as $v => $value ) {
			$c[$i] = $this->countBasedOnDay($fb->subscriber_id, $value);
			$i++;
		}
		$total = 0;
		for ( $i = 0; $i < count($c); $i++ ) {
			$total += $c[$i];
		}
		for ( $i = 0; $i < count($c); $i++ ) {
			$res[$i] = ((float)$c[$i]/(float)$total)*100;
		}
		echo "<script type=\"text/javascript\" src=\"jquery.min.js\"></script>
		<script type=\"text/javascript\">
$(function () {
        $('#visitstat').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Statistik Kehadiran Anda'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Anggota airabooks',";
                echo "data:[";
					//for ( $i = 0; $i < count($res); $i++ ) {
					//	echo "['".$genre_list[$i]."',".$res[$i]."],";
						$i = 0;
						foreach ($day_list as $v => $value ) {
							echo "['".$v."',".$res[$i++]."],";
						}
				echo "]";
				/*data: [
                    ['Laki - Laki',   ".$maleper."],
                    {
                        name: 'Perempuan',
                        y: ".$femaleper.",
                        sliced: true,
                        selected: true
                    }
                ]*/
				echo
				"
            }]
        });
    });
    

		</script>
		";
	}
}


?>
