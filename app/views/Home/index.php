<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php $this->view("Navbar",[]); ?>

<div class="main">
  <form action="" method="POST">
    <input name="year" style="width: 300px;" placeholder="Year Input" class="form-control" type="number" min="1900" max="2099" step="1" value="<?php
    if(isset($_POST['year'])){
      echo $_POST['year'];
    }
    ?>" />
  </form>
  
  
  <?php
  if(isset($_POST['year'])){ ?>
    <div>
      <canvas id="myChart""></canvas>
    </div>
  <?php
  }
  ?>
  
  
</div>

<?php
  if(isset($data['data_chart'])){ ?>

  <script>
      const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'Agust',
        'September',
        'October',
        'November',
        'Desember'
      ];
      const data = {
        labels: labels,
        datasets: [
          {
            label: 'Salary',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [
              <?= $data['data_chart']['January'] ?>,
              <?= $data['data_chart']['February'] ?>,
              <?= $data['data_chart']['March'] ?>,
              <?= $data['data_chart']['April'] ?>,
              <?= $data['data_chart']['May'] ?>,
              <?= $data['data_chart']['June'] ?>,
              <?= $data['data_chart']['July'] ?>,
              <?= $data['data_chart']['August'] ?>,
              <?= $data['data_chart']['September'] ?>,
              <?= $data['data_chart']['October'] ?>,
              <?= $data['data_chart']['November'] ?>,
              <?= $data['data_chart']['Desember'] ?>,
            ]
          },
          // {
          //   label: 'Tes',
          //   backgroundColor: 'rgb(255, 99, 132)',
          //   borderColor: 'blue',
          //   data: [10, 20, 30, 40, 50, 34, 22],
          // }
      ],
        
      };
      const config = {
        type: 'line',
        data: data,
        options: {}
      };


      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
  </script>
<?php
}
?>
