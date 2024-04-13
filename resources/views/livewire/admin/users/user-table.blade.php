<div>
   @foreach ($users as $user)
       <div>{{ $user->hospital->name }}</div>
       <!-- Access other hospital properties as needed -->
   @endforeach
</div>

