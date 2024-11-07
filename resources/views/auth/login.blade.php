<form method="POST" action="{{ route('login') }}" class="p-4 border rounded shadow-sm" style="max-width: 400px; margin: auto; background-color: #f9f9f9;">
    @csrf
    <h2 class="text-center mb-4" style="color: #343a40;">Login</h2>

    <!-- Username input -->
    <div class="mb-3">
        <label for="username" class="form-label" style="font-weight: bold; color: #343a40;">Username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter your username" required style="border-radius: 0.5rem; padding: 0.75rem;">
        @error('username')
            <div class="invalid-feedback" style="font-size: 0.9rem; color: #dc3545;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password input -->
    <div class="mb-3">
        <label for="password" class="form-label" style="font-weight: bold; color: #343a40;">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required style="border-radius: 0.5rem; padding: 0.75rem;">
        @error('password')
            <div class="invalid-feedback" style="font-size: 0.9rem; color: #dc3545;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit button -->
    <div class="d-grid">
        <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; border-radius: 0.5rem; padding: 0.75rem;">Login</button>
    </div>
</form>
