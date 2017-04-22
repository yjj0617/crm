<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;

class UploadController 
{
	protected $app;
   	
   	public function __construct(ContainerInterface $ci) {
       $this->app = $ci;
   	}
   	public function __invoke($request, $response, $args) {
        //to access items in the container... $this->ci->get('');
   	}
   	
    public function upload($request, $response, $args){
    	global $flag,$msg,$data,$db;
      $filename = strtotime(date('Y-m-d H:i:s x'));
      $dis = date('Ymd');
      $handle = new upload($_FILES['file']);
      if($handle->image_src_type == 'png' || $handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'gif'){
          
          if($handle->uploaded) {
            $handle->file_new_name_body   = $filename;
            $handle->image_resize         = false;
            $handle->process('/var/www/assets/u/'.$dis);
            if($handle->processed){
              $name = $handle->file_dst_name;
              $an = 'u/'.$dis.'/'.$handle->file_dst_name;
            }
          }
          if($handle->uploaded) {
            $handle->file_new_name_body   = $filename;
            $handle->file_name_body_pre = 'thumb_';
            $handle->image_resize         = true;
            $handle->image_x              = 320;
            $handle->image_y              = 320;
            $handle->image_ratio_fill     = true;
            $handle->image_ratio_crop     = true;
            $handle->process('/var/www/assets/u/'.$dis);
            if($handle->processed){
              $bn = 'u/'.$dis.'/'.$handle->file_dst_name;
              $data['thumbnail'] = $bn;
            }
          }
          if($handle->uploaded) {
            $handle->file_new_name_body   = $filename;
            $handle->file_name_body_pre = '640_thumb_';
            $handle->image_resize         = true;
            $handle->image_x              = 640;
            $handle->image_y              = 640;
            $handle->image_ratio_fill     = true;
            $handle->process('/var/www/assets/u/'.$dis);
            if($handle->processed){
              $cn = 'u/'.$dis.'/'.$handle->file_dst_name;
              $handle->clean();
            }
          }
          //写入数据库
          $a = $db->insert('mcms_attachment',[
              'name'=>$name,
              'fromID'=>$_COOKIE['staffID'],
              'type'=>0,
              'uri'=>$an,
              'thumbnail'=>$bn,
              'thumbnail_640'=>$cn,
              'creatTime'=>date('Y-m-d H:i:s')
            ]);
          $flag = 200;
          $data['uri'] = $a;
          $msg = '已上传并生成缩略图';
        }else{
          if($handle->uploaded){
            $handle->file_new_name_body = $filename;
            $handle->process('/var/www/assets/u/'.$dis);
            if($handle->processed){
              $a = $db->insert('mcms_attachment',[
                'name'=>$handle->file_dst_name,
                'fromID'=>$_COOKIE['staffID'],
                'type'=>1,
                'uri'=>'u/'.$dis.'/'.$handle->file_dst_name,
                'creatTime'=>date('Y-m-d H:i:s')
              ]);
              $flag = 200;
              $data['uri'] = $a;
              $msg = '文件非图片类型。';
            }
          }else{
            $flag = 400;
            $msg = '错误: '.$handle->error;
          }
        }

  		$json = array('flag' => $flag,'msg' => $msg, 'data' => $data);
      return $response->withJson($json);
    }

    public function uploadPic($request, $response, $args){
      global $flag,$msg,$data,$db;
      $filename = strtotime(date('Y-m-d H:i:s x'));
      $dis = date('Ymd');
      $handle = new upload($_FILES['uppic']);

      if($handle->image_src_type == 'png' || $handle->image_src_type == 'jpg' || $handle->image_src_type == 'gif'){
          
          if($handle->uploaded) {
            $handle->file_new_name_body   = $filename;
            $handle->image_resize         = false;
            $handle->process('/var/www/assets/u/'.$dis);
            if($handle->processed){
              $name = $handle->file_dst_name;
              $an = 'u/'.$dis.'/'.$handle->file_dst_name;
            }
          }
          if($handle->uploaded) {
            $handle->file_new_name_body   = $filename;
            $handle->file_name_body_pre = 'thumb_';
            $handle->image_resize         = true;
            $handle->image_x              = 320;
            $handle->image_y              = 320;
            $handle->image_ratio_fill     = true;
            $handle->image_ratio_crop     = true;
            $handle->process('/var/www/assets/u/'.$dis);
            if($handle->processed){
              $bn = 'u/'.$dis.'/'.$handle->file_dst_name;
              $data['thumbnail'] = $bn;
            }
          }
          if($handle->uploaded) {
            $handle->file_new_name_body   = $filename;
            $handle->file_name_body_pre = '640_thumb_';
            $handle->image_resize         = true;
            $handle->image_x              = 640;
            $handle->image_y              = 640;
            $handle->image_ratio_fill     = true;
            $handle->process('/var/www/assets/u/'.$dis);
            if($handle->processed){
              $cn = 'u/'.$dis.'/'.$handle->file_dst_name;
              $handle->clean();
            }
          }
          //写入数据库
          $a = $db->insert('mcms_attachment',[
              'name'=>$name,
              'fromID'=>$_COOKIE['staffID'],
              'type'=>0,
              'uri'=>$an,
              'thumbnail'=>$bn,
              'thumbnail_640'=>$cn,
              'creatTime'=>date('Y-m-d H:i:s')
            ]);
          $flag = 200;
          $data['uri'] = $a;
          $msg = '已上传并生成缩略图';
      }else{
          if($handle->uploaded){
            $handle->file_new_name_body = $filename;
            $handle->process('u/'.$dis);
            if($handle->processed){
              $a = $db->insert('mcms_attachment',[
                'name'=>$handle->file_dst_name,
                'fromID'=>$_COOKIE['staffID'],
                'type'=>1,
                'uri'=>'u/'.$dis.'/'.$handle->file_dst_name,
                'creatTime'=>date('Y-m-d H:i:s')
              ]);
              $flag = 200;
              $data['uri'] = $a;
              $msg = '文件非图片类型。';
            }

            $flag = 200;
            $msg = '文件上传成功'.$handle->image_src_type;

          }else{
            $flag = 400;
            $msg = '错误: '.$handle->error;
          }
      }
      
      
      $json = array('flag' => $flag,'msg' => $handle, 'data' => $data);
      return $response->withJson($json);
    }

    public function uploadfile($request, $response, $args){
      global $flag,$msg,$data,$db;
      $filename = strtotime(date('Y-m-d H:i:s x'));
      $dis = date('Ymd');
      $f = $_FILES['upfile'];
      $ft = $f['type'];
      $type = 1;

      switch ($ft){
        case 'application/pdf':
          $ftype = '.pdf';
          $type = 1;
        break; 
        case 'application/vnd.ms-excel':
          $ftype = '.xls';
          $type = 1;
        break;
        case 'application/msword':
          $ftype = '.doc';
          $type = 1;
        break;
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
          $ftype = '.xlsx';
          $type = 1;
        break;
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
          $ftype = '.docx';
          $type = 1;
        break;
        case 'text/plain':
          $ftype = '.txt';
          $type = 1;
        break;
        case 'video/mpeg':
          $ftype = '.mp4';
          $type = 2;
        break;
        case 'audio/mpeg':
          $ftype = '.mp3';
          $type = 3;
        break;
        case 'application/zip':
          $ftype = '.zip';
          $type = 1;
        break;
        case 'application/ocelet-stream':
          $ftype = '.rar';
          $type = 1;
        break;
        case 'application/x-shockwave-flash':
          $ftype = '.swf';
          $type = 4;
        break;
        default:
        $ftype = '.nov';
      }



      if($ftype!='.nov'){
         move_uploaded_file($_FILES['upfile']['tmp_name'], '/var/www/assets/u/'.$dis.'/'.$filename.$ftype);
          $a = $db->insert('mcms_attachment',[
                'name'=>$filename,
                'fromID'=>$_COOKIE['staffID'],
                'type'=>$type,
                'uri'=>'u/'.$dis.'/'.$filename.$ftype,
                'creatTime'=>date('Y-m-d H:i:s')
            ]);
            $flag = 200;
            $data['uri'] = $a;
            $msg = '上传已成功，文件类型：'.$ftype;
       }else{
          $flag = 400;
          $msg = '上传失败，不允许上传该格式文件。';
       }
     
      $json = array('flag' => $flag,'msg' => $msg, 'data' => $data);
      return $response->withJson($json);
    }

  
}
