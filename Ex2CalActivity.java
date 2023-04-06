package com.pdy.mystudyapp;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;

import androidx.appcompat.app.AppCompatActivity;

public class Ex2CalActivity extends AppCompatActivity {
    ImageView ivNum1,ivNum2,ivNum3,ivNum4,ivNum5,ivNum6,ivNum7,ivNum8,
            ivNum9,ivNum0,ivPlu,ivMin,ivMul,ivDiv,ivClear,ivResult;
    EditText etResult;

    int number[] = new int[10];//계산용 수를 저장하기위한배열
    int idx=0;//누른 순서를 카운팅 하기위한 변수
    int idxYon=0;//연속연산을 위한 연산 구분자
    int iNum;//현재숫자
    String strNum="";//표시용 현재숫자

    String yon[] = new String[9];//+ - * / 구분용
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ex2_cal);
        //id연동
        etResult = (EditText)findViewById(R.id.etResult);

        ivNum0 = (ImageView)findViewById(R.id.ivNum0);
        ivNum1 = (ImageView)findViewById(R.id.ivNum1);
        ivNum2 = (ImageView)findViewById(R.id.ivNum2);
        ivNum3 = (ImageView)findViewById(R.id.ivNum3);
        ivNum4 = (ImageView)findViewById(R.id.ivNum4);
        ivNum5 = (ImageView)findViewById(R.id.ivNum5);
        ivNum6 = (ImageView)findViewById(R.id.ivNum6);
        ivNum7 = (ImageView)findViewById(R.id.ivNum7);
        ivNum8 = (ImageView)findViewById(R.id.ivNum8);
        ivNum9 = (ImageView)findViewById(R.id.ivNum9);

        ivPlu = (ImageView)findViewById(R.id.ivPlu);
        ivMin = (ImageView)findViewById(R.id.ivMin);
        ivMul = (ImageView)findViewById(R.id.ivMul);
        ivDiv = (ImageView)findViewById(R.id.ivDiv);
        ivClear = (ImageView)findViewById(R.id.ivClear);
        ivResult = (ImageView)findViewById(R.id.ivResult);

        this.SetListener();
    }

    public void SetListener()
    {
        View.OnClickListener Listener = new View.OnClickListener(){
            @Override
            public void onClick(View view)
            {
                switch (view.getId()) {
                    case R.id.ivNum0:
                        strNum += "0";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum1:
                        strNum += "1";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum2:
                        strNum += "2";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum3:
                        strNum += "3";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum4:
                        strNum += "4";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum5:
                        strNum += "5";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum6:
                        strNum += "6";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum7:
                        strNum += "7";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum8:
                        strNum += "8";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivNum9:
                        strNum += "9";
                        etResult.setText(strNum);
                        break;
                    case R.id.ivPlu:
                        yon[idxYon] ="+";
                        etResult.setText("");
                        iNum = Integer.parseInt(strNum);
                        calcProc(idx,iNum,"+");
                        idx++;//터치하자마자 증가.다음수지정...
                        idxYon++;//연속연산시 처리하기위해서..
                        break;
                    case R.id.ivMin:
                        yon[idxYon] ="-";
                        etResult.setText("");
                        iNum = Integer.parseInt(strNum);
                        calcProc(idx,iNum,"-");
                        idx++;//터치하자마자 증가.다음수지정...
                        idxYon++;//연속연산시 처리하기위해서..
                        break;
                    case R.id.ivMul:
                        yon[idxYon] ="*";
                        etResult.setText("");
                        iNum = Integer.parseInt(strNum);
                        calcProc(idx,iNum,"*");
                        idx++;//터치하자마자 증가.다음수지정...
                        idxYon++;//연속연산시 처리하기위해서..
                        break;
                    case R.id.ivDiv:
                        yon[idxYon] ="/";
                        etResult.setText("");
                        iNum = Integer.parseInt(strNum);
                        calcProc(idx,iNum,"/");
                        idx++;//터치하자마자 증가.다음수지정...
                        idxYon++;//연속연산시 처리하기위해서..
                        break;
                    case R.id.ivResult:                        ;
                        etResult.setText("");
                        iNum = Integer.parseInt(strNum);
                        calcProc(idx,iNum,"=");
                        break;
                    case R.id.ivClear:                        ;
                        etResult.setText("");
                        strNum="";
                        for(int i=0;i<number.length;i++)
                        {
                            number[i]=0;
                        }
                        for(int i=0;i<yon.length;i++)
                        {
                            yon[i]="";
                        }
                        idx=0;
                        idxYon=0;
                        break;
                }

            }
        };

        ivNum0.setOnClickListener(Listener);
        ivNum1.setOnClickListener(Listener);
        ivNum2.setOnClickListener(Listener);
        ivNum3.setOnClickListener(Listener);
        ivNum4.setOnClickListener(Listener);
        ivNum5.setOnClickListener(Listener);
        ivNum6.setOnClickListener(Listener);
        ivNum7.setOnClickListener(Listener);
        ivNum8.setOnClickListener(Listener);
        ivNum9.setOnClickListener(Listener);
        ivPlu.setOnClickListener(Listener);
        ivMin.setOnClickListener(Listener);
        ivMul.setOnClickListener(Listener);
        ivDiv.setOnClickListener(Listener);
        ivResult.setOnClickListener(Listener);
        ivClear.setOnClickListener(Listener);
    }

    void calcProc(int idx, int num, String gubun)
    {
        number[idx]=num;
        //보여지는 문자열변수초기화
        strNum="";
        if(gubun.equals("="))
        {
            int result=0;//결과값
            int cnt=0;
            for(int i=0; i<idx;i++)
            {
                if(yon[cnt].equals("+"))
                {
                    number[0]+=number[i+1];
                }
                else if(yon[cnt].equals("-"))
                {
                    number[0]-=number[i+1];
                }
                if(yon[cnt].equals("*"))
                {
                    number[0]*=number[i+1];
                }
                if(yon[cnt].equals("/"))
                {
                    number[0]/=number[i+1];
                }
                cnt++;
            }

            etResult.setText(number[0]+"");
        }
    }
}