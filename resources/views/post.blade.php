<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Butter Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta name="description" content="{{ $post->getMetaDescription() }}" />
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Butter Blog</a>
    </div>
  </nav>
  <div class="container my-4">
    <h1 class="mb-3">{{ $post->getTitle() }}</h1>
    <p class="text-muted">{{ $post->getSummary() }}</p>
    <div class="w-50 my-3">
      <img src="{{ $post->getFeaturedImage() }}" alt="{{ $post->getFeaturedImageAlt() }}" class="img-fluid" />
    </div>
    <div class="overflow-hidden">
      {!! $post->getBody() !!}
    </div>
    <hr />
    <form action="{{ route('post.comment', ['slug' => $post->getSlug()]) }}" method="POST">
      @csrf
      <h4>Send Us Your Comment!</h4>
      @if (isset($successMessage) && strlen($successMessage))
        <div class="alert alert-success">{{ $successMessage }}</div>
      @endif
      @if (isset($errorMessage) && strlen($errorMessage))
        <div class="alert alert-error">{{ $errorMessage }}</div>
      @endif
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>