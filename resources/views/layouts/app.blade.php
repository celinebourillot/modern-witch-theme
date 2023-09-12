<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    <script src="https://consent.cookiefirst.com/banner.js" data-cookiefirst-key="b0012527-7784-4a43-a559-4022da485257"></script>
    <div class="wrap" role="document">
    @php do_action('get_header') @endphp
    @include('partials.header')
    
        <main class="main">
          @yield('content')
        </main>
      <div class="normal-footer">
        @php do_action('get_footer') @endphp
        @include('partials.footer')
        @php wp_footer() @endphp
      </div>
    </div>
  </body>
</html>
