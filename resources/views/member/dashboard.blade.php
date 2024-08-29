@extends('layouts.layouts')


@section('main')
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
                  <h6 id="jumlahBukuTersedia">Loading...</h6>
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
                  <i class="bx bx-book-reader"></i>
                </div>
                <div class="ps-3">
                  <h6 id="jumlahBukuDipinjam">Loading...</h6>
                </div>
              </div>
            </div>

          </div>
        </div>

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
        </div>

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
                      // Update the displayed data
                      document.getElementById('jumlahBukuTersedia').innerText = data.tersedia || '0';
                      document.getElementById('jumlahBukuDipinjam').innerText = data.dipinjam || '0';
                      document.getElementById('totalBuku').innerText = data.total || '0';

                      // Create the bar chart
                      new Chart(document.querySelector('#barChart'), {
                        type: 'bar',
                        data: {
                          labels: ['Buku Tersedia', 'Buku Dipinjam', 'Total Buku'],
                          datasets: [{
                            label: 'Jumlah Buku',
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
                      // Display errors if necessary
                      document.getElementById('jumlahBukuTersedia').innerText = 'Error';
                      document.getElementById('jumlahBukuDipinjam').innerText = 'Error';
                      document.getElementById('totalBuku').innerText = 'Error';
                    });
                });
              </script>
              <!-- End Bar Chart -->

            </div>
          </div>
        </div>
        <!-- End Reports -->

      </div>
    </div>
    <!-- End Left side columns -->

  </div>
</section>
@endsection

@section('css')
<!-- Add any custom CSS here -->
@endsection

@section('js')
<!-- Add any custom JS here -->
@endsection

@section('scripts')
<!-- Add any additional scripts here -->
@endsection
