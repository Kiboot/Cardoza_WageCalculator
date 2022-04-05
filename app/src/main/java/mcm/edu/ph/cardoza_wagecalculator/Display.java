package mcm.edu.ph.cardoza_wagecalculator;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.TextView;

//Wage Calculator

// Regular Employee:
// 1-8 hours(regular work time): 100 pesos per hour
// overtime(calculated each hour after the 8th work hour): 115 pesos per hour

// Probationary Employee:
// 1-8 hours: 90 pesos per hour
// overtime: 100 pesos per hour

// 90 x 8 = 720 pesos for that day
// 720 + (3 * 100) = 1020 for that day

// Part-time workers:
// 1-8 hours: 75 pesos per hour
// overtime: 90 pesos per hour


//Inputs:
// Name
// Employee type
// how many hours you have worked for that day

//Outputs:
// Display:
//      Total Wage Received
//      Total OT wage (if available)
//      Total Regular wage
//      hours rendered
//      hours OT (if available)


public class Display extends AppCompatActivity {

    TextView txtName,txtType,txtHours,txtWage;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_display);

        txtName = findViewById(R.id.txtEmployeeName);
        txtType = findViewById(R.id.txtEmployeeType);
        txtHours = findViewById(R.id.txtHours);
        txtWage = findViewById(R.id.txtTotalWage);



        Intent i = getIntent();

        String EmployeeType = i.getStringExtra("type");
        String EmployeeName = i.getStringExtra("empName");
        Double EmployeeHours = Double.parseDouble(i.getStringExtra("hours"));


        txtName.setText("Employee Name: " +EmployeeName);
        txtType.setText("Employee Type: " + String.valueOf(EmployeeType));
        txtHours.setText("Hours Rendered: "+ String.valueOf(EmployeeHours));

        calcWage(EmployeeType,EmployeeHours,txtWage);



    }
    //Method to calculate wage
    public void calcWage(String employeeType, Double employeeHours, TextView txtWage){
        Double totalWage = 0.0;




        if(employeeHours > 8.0){
            //overtime hours code
        }
        else{
            if(employeeType.equals("Full-time")){
                totalWage = employeeHours * 100;
                txtWage.setText("Total Wage: ₱" +String.valueOf(totalWage));
            }
            else if(employeeType.equals("Part-time")){
                totalWage = employeeHours * 75;
                txtWage.setText("Total Wage: ₱" +String.valueOf(totalWage));
            }
            else{
                totalWage = employeeHours * 90;
                txtWage.setText("Total Wage: ₱" +String.valueOf(totalWage));
            }
        }
    }





}