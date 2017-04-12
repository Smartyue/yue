<?php
/**
 * 下载
 * Created by PhpStorm.
 * User: yuanjianxin
 * Date: 2017/4/12
 * Time: 下午7:26
 */
namespace App\Tools;

class DownloadUtil{


    /**
     * 下载文件（csv）
     * @param $filename
     * @param null $data
     * @param null $head
     * @param null $fp
     * @return null|resource
     */
    public function download($filename,$data=null,$head=null,$fp=null)
    {
        if(is_bool($filename))
        {
            die();
        }
        if($fp===null)
        {
            header("Content-Type: text/csv");
            header("Content-Disposition:filename=$filename.csv");
            $fp = fopen('php://output', 'a');
            if($head!==null){
                foreach ($head as $key => $value) {
                    $head[$key] = iconv('utf-8', 'gbk', $value);;
                }
                fputcsv($fp, $head);
            }
        }
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 1000;
        // 逐行取出数据，不浪费内存
        $count = count($data);
        for($t=0;$t<$count;$t++) {
            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = $data[$t];
            foreach ($row as $key => $value) {
                $row[$key] = iconv('utf-8', 'gbk//ignore', $value);
            }
            fputcsv($fp, $row);
            unset($row);
        }
        ob_flush();
        flush();
        return $fp;
    }
}