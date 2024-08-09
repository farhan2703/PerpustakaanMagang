<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.header')
</head>

<body>
    <!-- Content -->
    <main id="main" class="main">
        <div class="container">
            <h2>Import Buku dari Excel</h2>

            <form action="{{ route('buku.import.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Pilih File Excel</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Import</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    @include('template.footer')
</body>
</html>
