#!/bin/bash



declare -a s1
s1[8]=469
s1[9]=472
s1[10]=500
s1[11]=474
s1[12]=496
s1[13]=469
s1[14]=503
s1[15]=497
s1[16]=469
s1[17]=487
s1[18]=466
s1[19]=480
s1[20]=482
s1[21]=473
s1[22]=460
s1[23]=495
s1[24]=481
s1[25]=490
s1[26]=483


declare -a s2
s2[8]=471
s2[9]=471
s2[10]=480
s2[11]=477
s2[12]=503
s2[13]=477 
s2[14]=507
s2[15]=502
s2[16]=462
s2[17]=480
s2[18]=488
s2[19]=469
s2[20]=472
s2[21]=483
s2[22]=459
s2[23]=479
s2[24]=474
s2[25]=482
s2[26]=463

declare -a s3
s3[8]=467
s3[9]=473 
s3[10]=474
s3[11]=473 
s3[12]=505
s3[13]=472
s3[14]=474
s3[15]=488
s3[16]=466
s3[17]=494
s3[18]=471
s3[19]=474
s3[20]=475
s3[21]=474
s3[22]=467
s3[23]=474
s3[24]=470
s3[25]=491
s3[26]=468


declare -a s4
s4[8]=462
s4[9]=473
s4[10]=485
s4[11]=469
s4[12]=514
s4[13]=471
s4[14]=476
s4[15]=484
s4[16]=467
s4[17]=482
s4[18]=487
s4[19]=476
s4[20]=472
s4[21]=486
s4[22]=473
s4[23]=477
s4[24]=466
s4[25]=495
s4[26]=464

########################################################## 
# filtered_sub8_s1.nii.gz
##########################################################
ROOTPATHMAC="/Users/boo/Desktop/fmri_script" 
TEMPLATE_PATH=$ROOTPATHMAC"/bash/bash_con_each_onsetP_template.fsf"

#ROOTPATH="/mnt/hgfs/zhang_bo/fmri_script"
ROOTPATH="/Users/boo/Desktop/fmri_script" 

for sub in {8..26}; do
for session in {1..4}; do

if [ $session -eq 1 ];then
NUM_VOLUME=${s1[$sub]}
fi
if [ $session -eq 2 ];then
NUM_VOLUME=${s2[$sub]}
fi
if [ $session -eq 3 ];then
NUM_VOLUME=${s3[$sub]}
fi
if [ $session -eq 4 ];then
NUM_VOLUME=${s4[$sub]}
fi
FEAT_FOLDER_NAME=$ROOTPATH"/NAYA"$sub"/fsl_con_onset_eachP_s"$session
BOLD_PATH=$ROOTPATH"/NAYA"$sub"/bold_run"$session"/sms_bold_run"$session"_mcf"
HEADMOTION=$ROOTPATH/head6p_del/sub$sub"_s"$session".txt"
T1PATH=$ROOTPATH"/NAYA"$sub"/t1/t1"


sed -e 's@FEAT_FOLDER_NAME@'$FEAT_FOLDER_NAME'@g' \
    -e 's@NUM_VOLUME@'$NUM_VOLUME'@g' \
    -e 's@HEADMOTION@'$HEADMOTION'@g' \
    -e 's@T1PATH@'$T1PATH'@g' \
    -e 's@BOLD_PATH@'$BOLD_PATH'@g' \
    -e 's@NUM_SUB@'$sub'@g' \
    -e 's@ROOTPATH@'$ROOTPATH'@g' \
    -e 's@NUM_SESSION@'$session'@g'  <$TEMPLATE_PATH> $ROOTPATHMAC"/bash/con_each_onsetP/fsf_sub"$sub"_s"$session".fsf"


done
done
 










