<footer class="fixed-bottom bg-white border-top py-2">
  <div class="container position-relative">
    <!-- Navigation Bar -->
    <div class="row justify-content-around text-center">
      <div class="col">
        <a href="{{ route('manager.home') }}" class="text-decoration-none text-primary">
          <i class="bi bi-house-door d-block"></i>
          <small>Home</small>
        </a>
      </div>
      <div class="col">
        <a href="#" class="text-decoration-none text-secondary">
          <i class="bi bi-heart d-block"></i>
          <small>Favorites</small>
        </a>
      </div>
      <div class="col">
        <a href="#" class="text-decoration-none text-secondary">
          <i class="bi bi-chat d-block"></i>
          <small>Chat</small>
        </a>
      </div>
      <div class="col">
        <!-- Profile Button with Popup -->
        <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#profileModal">
          <i class="bi bi-person d-block"></i>
          <small>Profile</small>
        </a>
      </div>
    </div>
  </div>
</footer>

<!-- Profile Modal (Popup from Bottom) -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-bottom">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <!-- Profile Icon and Name Aligned Horizontally -->
        <div class="d-flex align-items-center justify-content-center mb-3">
          <!-- Profile Image -->
          <img src="https://via.placeholder.com/150" class="rounded-circle" alt="Profile Icon" style="width: 80px; height: 80px;">
          <!-- Profile Name -->
          <div class="ms-3"> <!-- ms-3 adds margin to the left of the name -->
            <h5 class="mb-0">{{ Auth::user()->name }}</h5> <!-- Dynamic name -->
            <p class="text-muted">{{ Auth::user()->email }}</p>
          </div>
        </div>
        
        <!-- Pemisah/Garis -->
        <hr class="my-4">
          <!-- Tombol Pengaturan -->
  <a href="#" class="btn btn-outline-secondary mb-3 w-100">
    <i class="fas fa-cogs"></i> Pengaturan
  </a>

  <!-- Tombol Favorit -->
  <a href="#" class="btn btn-outline-secondary mb-3 w-100">
    <i class="fas fa-heart"></i> Favorit
  </a>

      
        <!-- Profile Description (optional) -->
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Optional: Add Bootstrap JS for modal functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
