<div class="card">
    <div class="card-body">
        <form action="<?php echo $base_url ?>/product/save" method="post">

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" type="text" name="name" id="name">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input class="form-control" type="text" name="price" id="price">
            </div>

            <div class="mb-3">
                <label for="manufacturer_id" class="form-label">Manufecturer_id</label>
                <select class="form-select" name="manufacturer_id" id="manufacturer_id">
                    <option value="1">Bangladesh</option>
                    <option value="2">USA</option>
                    <option value="3">UK</option>
                    <option value="4">Nepal</option>
                </select>
            </div>

            <input type="submit" name="btn_submit" id="" class="btn btn-primary">
        </form>
    </div>
</div>