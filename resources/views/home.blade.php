<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Butter Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Butter Blog</a>
    </div>
  </nav>
  <div class="container my-4">
    <div class="row">
      @forelse ($posts as $post)
        <div class="card col-2 col-md-4 me-2 p-0">
          <img src="{{ $post->getFeaturedImage() }}" class="card-img-top" alt="{{ $post->getFeaturedImageAlt() }}">
          <div class="card-body">
            <h5 class="card-title">{{ $post->getTitle() }}</h5>
            <p class="card-text">{{ $post->getSummary() }}</p>
            <a href="{{ route('post', ['slug' => $post->getSlug()]) }}" class="btn btn-primary">Read More</a>
          </div>
        </div>
      @empty
        <div class="card">
          <div class="card-body">
            <p class="card-text">There are no posts!</p>
          </div>
        </div>
      @endforelse
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>