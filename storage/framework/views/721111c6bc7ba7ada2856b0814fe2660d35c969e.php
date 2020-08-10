<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <br>
            <div class="card">
                <div class="card-header"><?php echo e(__('อัปโหลดรูปภาพ')); ?></div>

                <div class="card-body">       
                <form action="upload" method="post" enctype="multipart/form-data">  
                    <?php echo csrf_field(); ?>  
                    <div class="btn_giverate">
                        <label for="upload-photo" class="btn_blackdefault">รูปภาพ</label>
                        <input type="file" name="file" id="upload-photo" />
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">หมวดหมู่คลังรูปภาพ</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="catalogid">
                            <?php $__currentLoopData = $catalog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catalog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($catalog->c_id); ?>"><?php echo e($catalog->c_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                   <br>
                    <button type="submit" class="btn btn-secondary">อัปโหลดรูปภาพ</button>
                </form>
                </div>
                
            </div>

            <br>
            <div class="card">
                <div class="card-header"><?php echo e(__('รายการรูปภาพ')); ?></div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">ขนาด</th>
                        <th scope="col">นามสกุล</th>
                        <th scope="col">หมวดหมู่คลังรูปภาพ</th>
                        <th scope="col">แก้ไข/ลบ</th>
                      </tr>
                    </thead>

                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tbody>
                      <tr>
                      
                        <td><img src="storage/images/<?php echo e($item->name); ?>" width="250"></td>
                        <td><?php echo e($item->size/1000); ?> kb</td>
                        <td><?php echo e($item->mime); ?></td>
                        <td>
                            <?php
                            $catalogname = DB::table('catalog')->where('c_id',$item->c_id)
                            ->get();
                            ?>
                             <?php
                             $catalog2 = $catalog2 = DB::table('catalog')->get();
                             ?>
                            <?php $__currentLoopData = $catalogname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catalogname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($catalogname->c_name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <br>
                            <div class="form-group">
                                <form action="updatecatalog" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" value="<?php echo e($item->id); ?>" name="photoid">
                                <select class="form-control" id="exampleFormControlSelect1" name="catalogid">
                                <option value="">เลือกหมวดหมู่</option>
                                    <?php $__currentLoopData = $catalog2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catalog2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($catalog2->c_id); ?>"><?php echo e($catalog2->c_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">อัปเดต</button>
                                </form>
                              </div>
                        </td>
                        
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">แก้ไข</button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">แก้ไขรูปภาพ</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="update" method="post" enctype="multipart/form-data">  
                                            <?php echo csrf_field(); ?>  
                                        <input type="hidden" name="photoid" value="<?php echo e($item->id); ?>">
                                        <div class="btn_giverate">
                                            <label for="upload-photo" class="btn_blackdefault">รูปภาพ</label>
                                            <input type="file" name="file" id="upload-photo" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-primary">อัปโหลดรูปภาพ</button>
                                          </div>
                                      </form>
                                    </div>
                                   
                                  </div>
                                </div>
                              </div>


                            <form  method="get" action="<?php echo e(url('delete/'.$item->id)); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <button type="sumbit" class="btn btn-danger">ลบ</button>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-test\laravel-test\resources\views/home.blade.php ENDPATH**/ ?>