<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Attachent component
 */
class AttachmentComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     *
     * This function for uload attachment excel file  from view of information style list
     * @param string upload target path
     * @param array() file attribute option from upload form
     * @param string specific you file name
     * @return  array()
     * @since   2017/10/30
     * @author  sarawutt.b
     */
    public function uploadFile($path, $file, $fileName = null)
    {
        //dd($file);
        $typeOK = false;
        $uploadPath = WWW_ROOT . $path;
        //$relURL = $path;
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath);
        }

//        debug($uploadPath);
//        debug($file);

        //dd($file->getError());
        //define for file type where it allow to upload
        $map = [
            'audio/mp3' => '.mp3',
            'video/mp4' => '.mp4',
            'image/bmp' => '.bmp',
            'image/gif' => '.gif',
            'image/jpeg' => '.jpg',
            'image/png' => '.png',
            'application/pdf' => '.pdf',
            'application/msword' => '.doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx',
            'application/excel' => '.xls',
            'application/vnd.ms-excel' => '.xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => '.xlsx'
        ];


        //Bould file extension keep to the database
        $fileExtension = substr($file->getClientFileName(), strrpos($file->getClientFileName(), '.') + 1);
        if (array_key_exists($file->getClientMediaType(), $map)) {
            $typeOK = true;
        }

//        debug($file->getError());
//        debug($file->getSize());
//        debug($fileExtension);
//        debug($typeOK);exit;
        //Rename for the file if not change of the upload file makbe duplicate
        if (empty($fileName)) {
            $fileName = $this->VERSION() . '.' . $fileExtension;
        }

        //dd($fileName);
        if ($typeOK) {
            switch ($file->getError()) {
                case 0:
                    $url = $uploadPath . DS . $fileName;
                    $file->moveTo($url);
                    $result['uploadPath'] = DS . $path . DS . $fileName;
                    $result['uploadFileName'] = $fileName;
                    $result['uploadExt'] = $map[$file->getClientMediaType()];
                    $result['uploadOriginFileName'] = $file->getClientFileName();
                    $result['uploadFileType'] = $file->getClientMediaType();
                    $result['uploadFileSize'] = $file->getSize();
                    break;
                case 3:
                    $result['uploadError'] = __("Error uploading {$fileName}. Please try again.");
                    break;
                case 4:
                    $result['noFile'] = __("No file Selected");
                    break;
                default:
                    $result['uploadError'] = __("System error uploading {$fileName}. Contact webmaster.");
                    break;
            }
        } else {
            $result['uploadError'] = __("{$fileName} cannot be uploaded. Acceptable file types in : {0}", implode(', ', $map));
        }
        return $result;
    }

    /**
     *
     * Function used fro generate _VERSION_
     * @return  biginteger of the version number
     * @author  sarawutt.b
     */
    public function VERSION()
    {
        $parts = explode(' ', microtime());
        $micro = $parts[0] * 1000000;
        return (substr(date('YmdHis'), 2) . sprintf("%06d", $micro));
    }
}
