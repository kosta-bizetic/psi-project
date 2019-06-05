<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/userProfile.css') ?>">
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            $this->load->view('user/partial/userProfile.php', $this->data);
        ?>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <canvas id="genderPie" class="col-md-4"></canvas>
                <canvas id="ageHisto" class="col-md-4"></canvas>
            </div>
        </div>
        <script>
            var genderCtx = document.getElementById('genderPie').getContext('2d');
            new Chart(genderCtx, {
                    type: 'pie',
                    data: {
                            datasets: [{
                                    data: [
                                        <?php echo implode(', ', $genders); ?>
                                    ],
                                    backgroundColor: [
                                            'rgba(54, 162, 235, 0.5)',
                                            'rgba(255, 99, 132, 0.5)',
                                    ],
                                    label: 'Gender'
                            }],
                            labels: [
                                    <?php echo "'".implode("', '", array_keys($genders))."'"; ?>
                            ]
                    },
                    options: {
                            responsive: true
                    }
            });

            var ageCtx = document.getElementById('ageHisto').getContext('2d');
            new Chart(ageCtx, {
                    type: 'bar',
                    data: {
                            datasets: [{
                                    data: [
                                        <?php echo $age[0] ?>,
                                        <?php echo $age[1] ?>,
                                        <?php echo $age[2] ?>,
                                        <?php echo $age[3] ?>,
                                        <?php echo $age[4] ?>,
                                    ],
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    label: 'Number of followers',
                                    xAxisID: 0
                            }],
                            labels: [
                                    '18-25',
                                    '26-40',
                                    '41-60',
                                    '61-80',
                                    '81+'
                            ]

                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });

        </script>
    </body>
</html>
