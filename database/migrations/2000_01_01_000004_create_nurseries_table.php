<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNurseriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return  void
	 */
	public function up()
	{
	    //班级
	    Schema::create('grades', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('name',150)->comment = '班级名称';
	        $table->year('year')->comment = '年份';
	        $table->date('start_date')->comment = '起始时间';
	        $table->date('end_date')->comment = '结束时间';
	        $table->unsignedInteger('pic_id')->default(0)->comment = '班级图片';
	        $table->text('info')->nullable()->comment = '班级介绍';
	        $table->integer('class_id')->unsigned()->comment = '0.小班 1.中班 2.大班 3.学前班 4.一年级 5.二年级 6.三年级 7.四年级 8.五年级 9.六年级';
	        $table->timestamps();
	        $table->softDeletes(); //软删除
	    });
	    //教师
	    Schema::create('teachers', function (Blueprint $table) {
	        $table->unsignedInteger('id')->index();
	        $table->string('name',250)->comment='老师名称';
	        $table->unsignedInteger('pic_id')->default(0)->comment = '文章图片';
	        $table->text('contents')->nullable()->comment = '问题内容';
	        $table->softDeletes(); //软删除
	           
	        $table->primary(['id']);
	        $table->foreign('id')->references('id')->on('users')
	            ->onUpdate('cascade')->onDelete('cascade');
	        $table->timestamps();
	    });
	    //老师与班级关系
	    Schema::create('teacher_grade', function (Blueprint $table) {
	       $table->integer('gid')->unsigned()->index()->comment = '班级ID';
	       $table->integer('tid')->unsigned()->index()->comment = '教师ID';
	       $table->tinyInteger('is_now')->index()->default(0)->comment == '是否现任班级，0.否 1.是';
	       $table->foreign('gid')->references('id')->on('grades')
	       ->onUpdate('cascade')->onDelete('cascade');
	       $table->foreign('tid')->references('id')->on('users')
	       ->onUpdate('cascade')->onDelete('cascade');
	       
	       $table->primary(['gid', 'tid']);
	       $table->timestamps();
	    });
	    //学生与班级的关系 
	    Schema::create('student_grade', function (Blueprint $table) {
	       $table->integer('gid')->unsigned()->index()->comment = '班级ID';
	       $table->integer('sid')->unsigned()->index()->comment = '学生ID';
	       $table->tinyInteger('is_now')->index()->default(0)->comment == '是否现读班级，0.否 1.是';
	       $table->foreign('gid')->references('id')->on('grades')
	           ->onUpdate('cascade')->onDelete('cascade');
	       $table->foreign('sid')->references('id')->on('users')
	           ->onUpdate('cascade')->onDelete('cascade');
	        
	       $table->primary(['gid', 'sid']);
	       $table->timestamps();
	    });
	    //家长表
	    Schema::create('parents', function (Blueprint $table) {
	       $table->unsignedInteger('id')->index();
	       $table->string('name',250)->comment='家长名';
	       $table->string('relation',10)->comment='称谓:父亲、母亲等';
	       $table->softDeletes(); //软删除
	         
	       $table->foreign('id')->references('id')->on('users')
	            ->onUpdate('cascade')->onDelete('cascade');
	       $table->timestamps();
	    });
	    //学生与父母对应关系
	    Schema::create('student_parent', function (Blueprint $table) {
	       $table->integer('pid')->unsigned()->index()->comment = '父母ID';
	       $table->integer('sid')->unsigned()->index()->comment = '学生ID';
	       $table->foreign('pid')->references('id')->on('parents')
	           ->onUpdate('cascade')->onDelete('cascade');
	       $table->foreign('sid')->references('id')->on('users')
	           ->onUpdate('cascade')->onDelete('cascade');
	             
	       $table->primary(['pid', 'sid']);
	       $table->timestamps();
	    });
	    //0.幼儿园介绍  1:新闻掠影  2.招生招聘 3.联系我们
	    Schema::create('articles', function (Blueprint $table) {
	        $table->increments('id');
	        $table->integer('user_id')->unsigned()->comment = '发表用户ID';
	        $table->string('title',150)->comment = '标题';
	        $table->unsignedInteger('pic_id')->default(0)->comment = '文章图片';
	        $table->text('contents')->nullable()->comment = '问题内容';
	        $table->tinyInteger('type')->index()->default(0)->comment = '文章类型 0.幼儿园介绍  1:新闻掠影  2.招生招聘 3.联系我们 ';
	        $table->timestamps();
	        $table->softDeletes(); //软删除
	    });
		//通知-公告
		Schema::create('notices', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title',150)->unique()->comment = '标题';
			$table->text('contents')->nullable()->comment = '通知内容';
			$table->timestamps();
			$table->softDeletes(); //软删除
		});

		//特色课程
		Schema::create('commercials', function (Blueprint $table) {
			$table->increments('id');
	        $table->string('title',150)->comment = '标题';
	        $table->unsignedInteger('pic_id')->default(0)->comment = '文章图片';
	        $table->text('contents')->nullable()->comment = '内容';
	        $table->integer('class_id')->unsigned()->comment = '0.小班 1.中班 2.大班 3.学前班 4.一年级 5.二年级 6.三年级 7.四年级 8.五年级 9.六年级';
	        $table->timestamps();
	        $table->softDeletes(); //软删除
		});
		//成长日记
		Schema::create('ceanzas', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id')->unsigned()->comment = '发表用户ID';
		    $table->string('title',150)->comment = '标题';
		    $table->unsignedInteger('pic_id')->default(0)->comment = '文章图片';
		    $table->text('contents')->nullable()->comment = '内容';
		    $table->integer('grade_id')->unsigned()->comment = '年级ID';
		    $table->timestamps();
		    $table->softDeletes(); //软删除
		});
		//有关系表
		//成长-学生
		Schema::create('ceanza_student', function (Blueprint $table) {
		    $table->integer('sid')->unsigned()->comment = '用户ID';
		    $table->integer('cid')->unsigned()->comment = '成长id';
		    
		    $table->foreign('sid')->references('id')->on('users')
		       ->onUpdate('cascade')->onDelete('cascade');
		    $table->foreign('cid')->references('id')->on('ceanzas')
		        ->onUpdate('cascade')->onDelete('cascade');
		    
		    $table->primary(['sid', 'cid']);
		 });
		 //成长-教师
		 Schema::create('ceanza_teacher', function (Blueprint $table) {
		    $table->integer('tid')->unsigned()->comment = '用户ID';
		    $table->integer('cid')->unsigned()->comment = '成长id';
		    
		    $table->foreign('tid')->references('id')->on('users')
		       ->onUpdate('cascade')->onDelete('cascade');
		    $table->foreign('cid')->references('id')->on('ceanzas')
		       ->onUpdate('cascade')->onDelete('cascade');
		    
		    $table->primary(['tid', 'cid']);
		 });
		 //相册
		 Schema::create('albums', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id')->unsigned()->comment = '发表用户ID';
		    $table->unsignedInteger('pic_id')->default(0)->comment = '文章图片';
		    $table->string('descript',50)->nullable()->comment = '图片描述';
		    $table->integer('grade_id')->unsigned()->comment = '年级ID';
		    $table->integer('class_id')->unsigned()->comment = '相册ID';
		    $table->timestamps();
		    $table->softDeletes(); //软删除
		});
		//有关系表
	    //相册-学生
		Schema::create('album_student', function (Blueprint $table) {
		    $table->integer('sid')->unsigned()->comment = '学生ID';
		    $table->integer('aid')->unsigned()->comment = '相册id';
		     
		    $table->foreign('sid')->references('id')->on('users')
		      ->onUpdate('cascade')->onDelete('cascade');
		    $table->foreign('aid')->references('id')->on('ceanzas')
		      ->onUpdate('cascade')->onDelete('cascade');
		     
		    $table->primary(['sid', 'aid']);
		});
		//相册-教师
		Schema::create('album_teacher', function (Blueprint $table) {
		    $table->integer('tid')->unsigned()->comment = '教师ID';
		    $table->integer('aid')->unsigned()->comment = '相册id';
		     
		    $table->foreign('tid')->references('id')->on('users')
		      ->onUpdate('cascade')->onDelete('cascade');
		    $table->foreign('aid')->references('id')->on('ceanzas')
		      ->onUpdate('cascade')->onDelete('cascade');
		     
		    $table->primary(['tid', 'aid']);
		});
		//相册分类
		Schema::create('album_classes', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('grade_id')->unsigned()->comment = '年级ID';
		    $table->string('name', 150)->index()->comment = '英文名称';
		    $table->string('title', 150)->comment = '名称';
		    $table->string('description', 250)->nullable()->comment = '';
		    $table->text('extra')->nullable()->comment = '扩展数据';
		    $table->unsignedInteger('pid')->index()->default(0)->comment = '父ID';
		    $table->unsignedInteger('level')->index()->default(0)->comment = 'tree level';
		    $table->text('path')->nullable()->comment = 'tree path';
		    $table->unsignedInteger('order_index')->default(0)->index()->comment = 'tree order';
		    $table->timestamps();
		    $table->softDeletes();
		    
		    $table->unique(['grade_id', 'name']);		});
		//发现banner
		Schema::create('banners', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('title',150)->comment = '标题';
		    $table->string('url',150)->comment = 'url';
		    $table->unsignedTinyInteger('status')->default(1)->comment = '状态：1,上架；0，下架';
		    $table->unsignedTinyInteger('location')->default(0)->comment = '位置：0.首页';
		    $table->unsignedInteger('cover')->comment = '封面';
		    $table->unsignedInteger('porder')->index()->comment = '排序id';
		    $table->timestamps();
		});
	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return  void
	 */
	public function down()
	{
		Schema::drop('grades');
		Schema::drop('teachers');
		Schema::drop('teacher_grade');
		Schema::drop('parents');
		Schema::drop('student_parent');
		Schema::drop('student_grade');
		Schema::drop('articles');
		Schema::drop('notices');
		Schema::drop('commercials');
		Schema::drop('ceanzas');
		Schema::drop('ceanza_student');
		Schema::drop('ceanza_teacher');
		Schema::drop('albums');
		Schema::drop('album_student');
		Schema::drop('album_teacher');
		Schema::drop('banners');
	}
}
