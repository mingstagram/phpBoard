<?php
  set_time_limit(0);
  ini_set('memory_limit', '512M');    
 
  echo "<META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=UTF-8'>";
 
  $TB_WIDTH = 1970;
 
  $filename = iconv('UTF-8', 'CP949', "테스트.xls");
 
  header( "Content-type: application/vnd.ms-excel" );
  header( "Expires: 0" );
  header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
  header( "Pragma: public" );
  header( "Content-Disposition: attachment; filename=" .$filename);
 
  echo "
    <table width=" .$TB_WIDTH. " border=1>
  ";
 
  for( $i=0; $i < 300000; $i++ ){
 
    echo "
    <tr height='40' align='center'>
      <td>fdsafsdafdsa</td>
      <td>fasddfsadfasdf</td>
      <td>fdsafasfsaf<br style='mso-data-placement:same-cell;'/>(fsdafasf)</td>
      <td style=mso-number-format:'\@'>fasfsdf</td>
      <td style=mso-number-format:'\@'>fdasfsadf</td>
      <td style=mso-number-format:'\@'>fasfdsa</td>
      <td>fsadfasf</td>
      <td>fsadfasfsa</td>
      <td>fsadfasdf</td>
      <td>fsdafasdfasdf</td>
    </tr>
    ";
 
  }//end of foreach
 
  echo "
  </table>
  ";
 
?>

<script type="text/javascript">
self.close();
</script>