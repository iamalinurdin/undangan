<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Anniversary Frans & Virgie</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .icon {
                height: 75px;
                width: 75px;
                border: 2px solid;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
                margin: 0 auto;
            }

            .main-color {
                background-color: #ead5be;
            }

            .secondary-color,
            .form-control:focus {
                background-color: #ead5be60;
            }
        </style>
    </head>
    <body>
        @if (Session::has('confirm'))
        <div class="container">
            <div class="alert mt-3 alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('confirm') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="h-100">
            <div class="text-center">
                <img src="{{ asset('photo.jpeg') }}" class="img-fluid">
            </div>
        </div>

        <div class="text-center d-flex flex-column justify-content-around gap-5 main-color py-5">
            <h3 class="fw-bold text-uppercase">
                wedding anniversary invitation
            </h3>
            <div class="date">
                <div class="icon">
                    <i class="fa-regular fa-calendar-days fa-xl"></i>
                </div>
                <h4 class="mt-2">Rabu,</h4>
                <h5 class="mt-2">9 November 2022 pkl 18:00</h5>
            </div>
            <div class="location">
                <div class="icon">
                    <i class="fa-solid fa-map-location-dot fa-xl"></i>
                </div>
                <h4 class="fw-bold text-uppercase mt-2">rock dome depok</h4>
            </div>

            <div class="w-100 mx-auto">
                <a href="https://www.google.com/maps/place/GBI+Rock+Depok/@-6.4015066,106.8324184,15z/data=!4m2!3m1!1s0x0:0x65eac44dabb3b8a4?sa=X&ved=2ahUKEwjZ3NLVxJf7AhUikeYKHbLkBhMQ_BJ6BAhbEAU" class="btn btn-transparent secondary-color text-dark rounded-pill p-3 border border-3 border-dark">
                    <i class="fa-solid fa-location-dot me-3"></i>
                    Kunjungi Lokasi Gmaps
                </a>
            </div>
        </div>

        <div class="main-color py-5 pb-3">
            <div class="container">
                <div class="col-12 offset-md-3 col-md-6">
                    <p class="text-center">Segala komentar dan tulisan yang Anda berikan adalah cerminan diri pribadi Anda! Terima kasih...</p>
                    <div class="card main-color">
                        <div class="card-header">
                            <i class="fa-solid fa-dove"></i>
                            <span>{{ $invitations->count() }} ucapan</span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item main-color">
                                <form action="{{ route('confirm') }}" method="POST" class="mt-3">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control border-dark main-color @error('name') is-invalid @enderror" name="name" placeholder="Nama Anda">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control main-color border-dark @error('message') is-invalid @enderror" name="message" rows="3" placeholder="Berikan ucapan & doa"></textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select main-color border-dark @error('is_attend') is-invalid @enderror" name="is_attend">
                                            <option selected disabled>Konfirmasi kehadiran</option>
                                            <option value="1">Hadir</option>
                                            <option value="0">Tidak Hadir</option>
                                        </select>
                                        @error('is_attend')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-transparent text-dark secondary-color border border-3 border-dark">
                                        Kirim
                                    </button>
                                </form>
                            </li>
                            @foreach ($invitations as $invitation)
                            <li class="list-group-item main-color">
                                <div>
                                    <span class="fw-bold">{{ Str::title($invitation->name) }}</span>
                                    @if ($invitation->is_attend)
                                    <span class="badge bg-success">
                                        Hadir
                                    </span>
                                    @else
                                    <span class="badge bg-warning">
                                        Tidak Hadir
                                    </span>
                                    @endif
                                </div>
                                <small>
                                    <i class="fa-solid fa-clock me-2"></i>
                                    {{ $invitation->created_at->diffForHumans() }}
                                </small>
                                <p>{{ $invitation->message }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-color text-center">
            <span class="fw-bold">Powered by</span>
            <h5 class="fw-bold" style="color: #cc2663;">PT. TOBIAS DIGITAL INDONESIA</h5>
            <img src="{{ asset('logo.png') }}" alt="">
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>
