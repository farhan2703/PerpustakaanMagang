
                    <!-- Bordered Table -->
                    
                    <table id="myTable" class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Tahun Terbit</th>
                                <th scope="col">Status</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Kategori</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Buku as $b)
                            <tr>
                                <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                <td>{{ $b->judul }}</td>
                                <td>{{ $b->penulis }}</td>
                                <td>{{ $b->penerbit }}</td>
                                <td>{{ $b->tahun_terbit }}</td>
                                <td>
                                  @if($b->stok > 0)
                                      <span class="badge bg-success">{{ $b->status_ketersediaan }}</span>
                                  @else
                                      <span class="badge bg-danger">Tidak tersedia</span>
                                  @endif
                              </td>
                              
                                <td>{{ $b->stok }}</td>
                                <td>{{ $b->kategori }}</td>
                                <th>
                                    <a href="{{ route('halaman.buku.detail', $b->id_buku) }}" class="btn light btn-secondary shadow btn-xs sharp mr-1"><i class="bi bi-info-circle"></i></a>
                                    <form id="editForm_{{ $b->id_buku }}" action="{{ route('halaman.buku.edit', $b->id_buku) }}" method="GET" style="display: inline;">
                                      @csrf
                                      <button type="submit" class="btn btn-warning shadow btn-xs sharp">
                                          <i class="bi bi-pencil-square"></i>
                                      </button>
                                  </form>
                                  <form action="{{ route('buku.forcedelete', $b->id_buku) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger shadow btn-xs sharp">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form></th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>