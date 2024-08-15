<!DOCTYPE html>
<html lang="en">

<head>
    @include('templatemember.header')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    @include('templatemember.headerbody')
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    @include('templatemember.sidebar')
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Buku <span>| Buku yang Tersedia</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bx-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="jumlahBukuTersedia"></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Buku <span>| Buku dalam Peminjaman</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bx-book-reader""></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="jumlahBukuDipinjam">Loading...</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Buku <span>| Total Buku</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-collection"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="totalBuku">Loading...</h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Grafik Buku</h5>
            
                  <!-- Bar Chart -->
                  <canvas id="barChart" style="max-height: 400px;"></canvas>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      // Fetch chart data
                      fetch("{{ route('chart-data') }}")
                        .then(response => response.json())
                        .then(data => {
                          new Chart(document.querySelector('#barChart'), {
                            type: 'bar',
                            data: {
                              labels: ['Buku Tersedia', 'Buku Dipinjam', 'Total Buku'],
                              datasets: [{
                                label: 'Buku Tersedia',
                                data: [data.tersedia, data.dipinjam, data.total],
                                backgroundColor: [
                                  'rgba(75, 192, 192, 0.2)', // Warna untuk Buku Tersedia
                                  'rgba(144, 238, 144, 0.2)', // Warna untuk Buku Dipinjam (Hijau Muda)
                                  'rgba(255, 159, 64, 0.2)'  // Warna untuk Total Buku
                                ],
                                borderColor: [
                                  'rgb(75, 192, 192)', // Warna border untuk Buku Tersedia
                                  'rgb(144, 238, 144)', // Warna border untuk Buku Dipinjam (Hijau Muda)
                                  'rgb(255, 159, 64)'  // Warna border untuk Total Buku
                                ],
                                borderWidth: 1
                              }]
                            },
                            options: {
                              scales: {
                                y: {
                                  beginAtZero: true
                                }
                              }
                            }
                          });
                        })
                        .catch(error => {
                          console.error("Error fetching chart data:", error);
                        });
                    });
                  </script>
                  <!-- End Bar Chart -->
            
                </div>
              </div>
            </div><!-- End Reports -->
            <!-- End Reports -->

           

          </div>
        </div>
        <!-- Left side columns -->
        <div class="col-lg-12">
            <!-- Customers Card -->
            
            
            
            <!-- End Customers Card -->

          </div>
        </div><!-- End Left side columns -->
        
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   @include('templatemember.scripts')
   <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch jumlah buku tersedia
        fetch("{{ route('jumlah-buku-tersedia') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById("jumlahBukuTersedia").textContent = data.jumlah;
            })
            .catch(error => {
                console.error("Error fetching jumlah buku tersedia:", error);
                document.getElementById("jumlahBukuTersedia").textContent = "Error";
            });

        // Fetch jumlah buku dipinjam
        fetch("{{ route('jumlah-buku-dipinjam') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById("jumlahBukuDipinjam").textContent = data.jumlah;
            })
            .catch(error => {
                console.error("Error fetching jumlah buku dipinjam:", error);
                document.getElementById("jumlahBukuDipinjam").textContent = "Error";
            });

        // Fetch total buku
        fetch("{{ route('total-buku') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById("totalBuku").textContent = data.total;
            })
            .catch(error => {
                console.error("Error fetching total buku:", error);
                document.getElementById("totalBuku").textContent = "Error";
            });
    });
</script>

</body>

</html>
