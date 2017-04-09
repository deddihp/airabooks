<?		
class UserStat 
{
function __construct() {
	}
function __destruct() {
	}
function countGender($gender) {
		$query = "select COUNT(*) as count from subscriber where gender='".$gender."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
function writeHeader() {
		
		$male = $this->countGender("MALE");
		$female = $this->countGender("FEMALE");

		$maleper = ((float)$male/(float)($male+$female))*100;
		$maleper = number_format((float)$maleper, 2, '.', '');
		$femaleper = (float)100-(float)$maleper;
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
                text: 'Statistik Anggota airabooks'
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
                name: 'Anggota airabooks',
                data: [
                    ['Laki - Laki',   ".$maleper."],
                    {
                        name: 'Perempuan',
                        y: ".$femaleper.",
                        sliced: true,
                        selected: true
                    }
                ]
            }]
        });
    });
    

		</script>
		";
	}
}


class GenreStat 
{
function __construct() {
	}
function __destruct() {
	}
function countGenre($genre) {
		$query = "select COUNT(*) as count from book_title where genre='".$genre."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
function calcPercent($val, $total) {
		return number_format((float)(((float)$val/(float)$total)*100), 2, '.', '');
	}
function writeHeader() {
		
		
		$fantasy = $this->countGenre("Adventure Fantasy");
		$romance = $this->countGenre("Romance");
		$mystery = $this->countGenre("Mystery");
		$action = $this->countGenre("Action");
		$drama = $this->countGenre("Drama");
		$sport = $this->countGenre("Sport");
		$detective = $this->countGenre("Detective");
		$comedy = $this->countGenre("Comedy");
		$history = $this->countGenre("History");
		$unspecified = $this->countGenre("Unspecified");
		
		$total = $fantasy + $romance + $mystery + $action + $drama
					+ $sport + $detective + $comedy + $history + $unspecified;
		$fantasy = $this->calcPercent($fantasy, $total);
		$romance = $this->calcPercent($romance, $total);
		$mystery = $this->calcPercent($mystery, $total);
		$action = $this->calcPercent($action, $total);
		$drama = $this->calcPercent($drama, $total);
		$sport = $this->calcPercent($sport, $total);
		$detective = $this->calcPercent($detective, $total);
		$comedy = $this->calcPercent($comedy, $total);
		$history = $this->calcPercent($history, $total);
		$unspecified = 100 - ($fantasy + $romance + $mystery + $action + $drama
					+ $sport + $detective + $comedy + $history);
		//$this->calcPercent($unspecified, $total);

		echo "<script type=\"text/javascript\" src=\"jquery.min.js\"></script>
		<script type=\"text/javascript\">
$(function () {
        $('#genrestat').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Statistik Genre'
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
                            return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage)+' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Genre',
                data: [
                    ['Fantasy',   ".$fantasy."],
                    {
                        name: 'Romance',
                        y: ".$romance.",
                        sliced: true,
                        selected: true
                    },
					['Mystery', ".$mystery."],
                ['Action', ".$action."],
                ['Drama', ".$drama."],
                ['Sport', ".$sport."],
                ['Detective', ".$detective."],
                ['Comedy', ".$comedy."],
                ['History', ".$history."],
                ['Unspecified', ".$unspecified."],
				]
            }]
        });
    });
    

		</script>
		";
	}
}

///////////////////////TimeTrans Stat
class TimeTransStat 
{
function __construct() {
	}
function __destruct() {
	}
function countTimeTrans($begin, $end) {
		$query = "select COUNT(*) as count from transaction where rent_time>='".$begin."' and rent_time<'".$end."'";
		$mysql = new MySQLComic($GLOBALS['COMIC_DB']);
		$result = $mysql->query($query);
		$row = mysqli_fetch_array($result);
		return $row['count'];
	}
function writeHeader() {
		
		$shift1 = $this->countTimeTrans("09:00:00", "14:00:00");
		$shift2 = $this->countTimeTrans("14:00:00", "18:00:00");
		$shift3 = $this->countTimeTrans("18:00:00", "23:00:00");

		$total = $shift1 + $shift2 + $shift3;
		$shift1 = ((float)$shift1/(float)$total)*100;
		$shift2 = ((float)$shift2/(float)$total)*100;
		$shift3 = ((float)$shift3/(float)$total)*100;

		echo "<script type=\"text/javascript\" src=\"jquery.min.js\"></script>
		<script type=\"text/javascript\">
$(function () {
        $('#ttstat').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Statistik Kehadiran Pelanggan'
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
                name: 'Waktu',
                data: [
                    ['09:00:00 - 14:00:00',   ".$shift1."],
                    {
                        name: '14:00:01 - 18:00:00',
                        y: ".$shift2.",
                        sliced: true,
                        selected: true
                    },
					['18:00:01 - 23:00:00', ".$shift3."],
                ]
            }]
        });
    });
    

		</script>
		";
	}
}
?>
