<form class="ml-auto" action="?">
    <div class="input-group">
        <input 
        name="search" 
        value="<?= request()->search ?>" 
        type="text" 
        class="form-control"
        placeholder="Search...">
    <div class="input-group-append">
        <button type="submit" class="btn btn-secondary">
            <i class="fas fa-search"></i>
        </button>
    </div>
    </div>
</form>