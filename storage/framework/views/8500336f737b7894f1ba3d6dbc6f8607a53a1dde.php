

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('สร้างcatalog')); ?></div>

                <div class="card-body">       
                <form action="createcatalog" method="post" >  
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ชื่อ catalog</label>
                        <input type="text"  name="c_name" class="form-control">
                      </div>
                   <br>
                    <button type="submit" class="btn btn-secondary">สร้างcatalog</button>
                </form>
                </div>
            </div>
            <br>

            <br>
            <div class="card">
                <div class="card-header"><?php echo e(__('รายการคลังรูปภาพ')); ?></div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">แก้ไข/ลบ</th>
                      </tr>
                    </thead>

                    <?php $__currentLoopData = $catalog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tbody>
                      <tr>
                   
                        <th scope="row"><?php echo e($item->c_name); ?></th>
                        <td>
                            <?php
                            $catalogname = DB::table('photo')->where('c_id',$item->c_id)
                            ->get();
                            ?>
                            <?php $__currentLoopData = $catalogname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catalogname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="storage/images/<?php echo e($catalogname->name); ?>" width="100">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">แก้ไข</button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">แก้ไขชื่อcatalog</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="updatenamecatalog" method="post" enctype="multipart/form-data">  
                                            <?php echo csrf_field(); ?>  
                                        <input type="hidden" name="photoid" value="<?php echo e($item->c_id); ?>">
                                        <div class="btn_giverate">
                                            <label for="exampleInputPassword1">ชื่อ catalog</label>
                                            <input type="text"  name="c_name" class="form-control" value="<?php echo e($item->c_name); ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-primary">แก้ไขชื่อหมวดหมู่</button>
                                          </div>
                                      </form>
                                    </div>
                                   
                                  </div>
                                </div>
                              </div>


                            <form  method="get" action="<?php echo e(url('deletecatalog/'.$item->c_id)); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <button type="sumbit" class="btn btn-danger">ลบข้อมูล</button>
                            </form>

                        </td>
                      </tr>
                    </tbody>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </table>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-test\laravel-test\resources\views/catalog.blade.php ENDPATH**/ ?>