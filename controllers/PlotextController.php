<?php
namespace app\controllers;
use app\components\MenuWidget;
use app\models\UploadZapis;
use yii\web\UploadedFile;
use Yii;
use app\models\Category;
use app\models\TablePrice;
use app\models\SetPrice;
use app\models\Plot;
use app\models\Sells;
class PlotextController extends AppController
{
    public function actionIndex()
    {
        $model = new UploadZapis();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                $zapis= $model->imageFile;
                $fileName = str_replace('\\','\\\\',  $zapis);

                $fd = fopen(Yii::getAlias('@app/uploads/'). $fileName, 'r') or die("не удалось открыть файл");
               /* while(!feof($fd))
                {
                    $str = htmlentities(fgets($fd));
                    echo $str;
                }
                fclose($fd); */
               $r=0; $str=array(); $perimetr=0; $width=0; $angles=0;
                $user_set=Yii::$app->user->identity;
                while (($row = fgetcsv($fd, 1000, ",")) != FALSE){

                    $str[$r]=$row;
                    //if($r == 1) {continue;} // Не импортируем первую строку (например, если там заголовки)
                    //записываем данные в БД
                  //  $ins="INSERT INTO `table_to_import` (`name`, `cost`, `count`) VALUES ('$row[0]', '$row[2]', '$row[4]')";
                 //   mysql_query($ins);
                    $r++;
                }
                fclose($fd);

                // блок записи данных в БД plot


              //  return Yii::$app->response->redirect(['plotext/profile', 'name' =>  $fileName]);
                $common_zap=array();
                $zap_in_stroka=array();
                $param_in_stroka= array();
               // $common_zap1=arra


// блок расчета цен
//
                $uid_first=array(); $uid_data=array();
            for($i=1; $i<count($str); $i++)
            {
                $common_zap=implode(';',$str[$i]);
                $common_zap1=explode(';',$common_zap);
              //  $common_zap=(object)$common_zap1;
                $k=count($common_zap1);
                $sum=(float)0;
                for ($j=0; $j<$k; $j++)
                {

                  $res=$common_zap1[$j];
                 // $rez1=substr($res,0,3);
                   $rez1=explode('=',$res); // проверить работу

                         if(($rez1[0]=='Ширинаполотна')or($rez1[0]=='Ширина полотна')or($rez1[0]=='ширинаполотна')or($rez1[0]=='ширина полотна'))
                         {
                          $width=explode('=',$rez1[1]);
                             $uid_data[0]= $width[0];
                         }
                        if(($rez1[0]=='Пер.помещения')or($rez1[0]=='пер.помещения')or($rez1[0]=='перпомещения')or($rez1[0]=='Перпомещения'))
                        {
                            $perimetr=explode('=',$rez1[1]);
                            $uid_data[1]= $perimetr[0];
                        }

                    if(($rez1[0]=='к-во углов')or ($rez1[0]=='к-воуглов'))
                    {
                        $angles=explode('=',$rez1[1]);
                        $uid_data[2]=$angles[0];
                    }




                      if($rez1[0]=='uid')
                      {
                        // $uid= substr($res,4);
                          $uid=explode('=',$res); //разбивает на два элемента [0],[1] в [0]-uid
                          $rez2=$common_zap1[$j-1];
                          $width=explode('=',$rez2); // предыдущий параметр ширина, периметр и т.д. [1]- значение
                          $rez3=$common_zap1[$j+1];
                          $qty=explode('=',$rez3); // ледующий параметр количество [1] - значение
                          if($width[1]==0) $width[1]=1;
                          if($qty[1]==0) $qty[1]=1;
                          $sum_promez=$width[1]*$qty[1];
                     //     $query1 = SetPrice::findOne(['_Fld216' =>$uid[1]]);
                        //  $potolok[$j]=CeilingItems::find()->where(['CeilingID' =>$it['ID']])->all();
                          $query = SetPrice::find()->where(['_Fld215RRef' =>$uid[1]])->all(); // uid товара
                          //$as=$query[0]['_Fld216'];

                          $sum+= $sum_promez*$query[0]->_Fld216;
                          $uid_first[]=$uid[1];




                      }
                }
                // сохранение ввода диллера в plot

                // сохранение чертежа в ceiling
                $ceil=new Sells();
                $ceil->category_id=2;
               $ceil->status=0;
                $ceil->potolok=substr($common_zap,0,148);
                $ceil->name=$common_zap1[0];
                $ceil->user_id= $user_set['id'];
                $ceil->perimetr= $uid_data[1];
                $ceil->square=$uid_data[0];
                $ceil->sum=$sum;
                $ceil->price=$query[0]->_Fld216;;
                $ceil->img=$common_zap1[1];
                $ceil->angels=$angles;
               // $uid_first=NULL;
                if(! $ceil->save(false))
                { echo "save false";  print_r($ceil->getErrors());  }
                else
                $ceil->save();

//  сброс файла lot
                $plot= new Plot();
                $plot->name=$common_zap1[0];
                $plot->img=$common_zap1[1];
                $plot->id_dealer=$user_set['id'];
                $plot->potolok=$common_zap;
                $plot->id_potolok=$ceil->id;
                if(! $plot->save(false))
                { echo "save false";  print_r($plot->getErrors());  }
                else
                    $plot->save();
                //   $plot->save();
            }

                $ass='Загрузка файла прошла успешно !';
                return  $this->render('view', compact('ass'));
            }
        }

        return $this->render('index', compact('model'));
    }

    public function actionProfile($name)
    {
        $fileName='http://localhost/ceil/uploads/'.$name;
        $fd = fopen("$fileName", 'r') or die("не удалось открыть файл");
        while(!feof($fd))
        {
            $str = htmlentities(fgets($fd));
            echo $str;
        }
        fclose($fd);
    }

}
