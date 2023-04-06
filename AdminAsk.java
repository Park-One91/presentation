package Library_Manager_Progrem;

import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class AdminAsk {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Ask ask = new Ask();
	}

}

class Ask extends Frame implements ActionListener
{
	Connection conn = null;
	String url = "jdbc:mysql://localhost:3306/rent?useUnicode=true&characterEncoding=utf8";	
	String id = "root";
	String pass = "qwer";
	Statement stmt = null;
	ResultSet rs = null;
	PreparedStatement pstmt = null;
	
	Label lbTitle = new Label("문의");
	Label lbSubject =    new Label("제목:");
	Label lbContent =    new Label("내용:");
	
	TextField tfSubject = new TextField();
	TextArea ta = new TextArea();
	
	Button btnReg = new Button("글등록");	
	Font font25 = new Font("TimesRoman", Font.PLAIN, 25);
	
	Ask()
	{
		super("Ask");
		this.setSize(350,450);
		this.init();//화면레이아웃구성메서드
		dbCon();
		start();
		this.setLocation(300, 100);
		this.setVisible(true);
	}
	
	void init() //레이아웃 구성하기...
	{
		this.setLayout(null);//레이아웃을 직접좌표처리하는방식으로하기위해서...		
		this.add(lbTitle);
		lbTitle.setBounds(20, 40, 200, 30);
		lbTitle.setFont(font25);
		this.add(lbSubject);
		lbSubject.setBounds(30, 100, 50, 30);		
		this.add(tfSubject);
		tfSubject.setBounds(90, 100, 200, 30);
		this.add(lbContent);
		lbContent.setBounds(30, 150, 80, 30);
		this.add(ta);	
		ta.setBounds(30, 180, 300, 170);
		this.add(btnReg);
		btnReg.setBounds(120, 360, 100, 40);		
				
		
	}
	
	void start() {
		btnReg.addActionListener(this);		
		
		this.addWindowListener(new WindowAdapter() {
			public void windowClosing(WindowEvent e) {
				viewClose(); 
			}
		});
	}
	
	void viewClose() {
		this.setVisible(false);
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		if(tfSubject.getText().equals(""))
		{
			dlgMsg("제목을 입력하세요");
			return;
		}
		else if(ta.getText().equals(""))
		{
			dlgMsg("내용을 입력하세요");
			return;
		}
		
		//글등록진행
		regist();
		tfSubject.setText("");
		ta.setText("");
		dlgMsg("등록 완료");
		
		BoardList.mList.removeAll();
		BoardList.dataLoad();
		this.setVisible(false);
		
		
		
	}
	
	void dlgMsg(String msg)
	{
		Dialog dlg = new Dialog(this, "게시글등록알림", true);
		Label lbContent = new Label(msg);
		Button bt = new Button("확인");		
		dlg.setLayout(null);		
		dlg.add(lbContent);	 
		dlg.add(bt);		
		lbContent.setBounds(50, 50, 200, 30);
		bt.setBounds(80, 120, 120, 30);		
		bt.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				dlg.setVisible(false);
			}
		});
		dlg.addWindowListener(new WindowAdapter() {
			public void windowClosing(WindowEvent e) {
				dlg.setVisible(false);
			}
		});		
		dlg.setLocation(800,400);
		dlg.setSize(300, 200);
		dlg.setVisible(true);
	}
	
	void regist()
	{	
		String pquery = "insert into tb_rent values (null, ?, ?, now(), ?)";	
		try {
			conn = DriverManager.getConnection(url, id, pass);
			pstmt = conn.prepareStatement(pquery);
			pstmt.setString(1, tfSubject.getText());
			pstmt.setString(2, ta.getText());
			pstmt.setString(3, "no");
			
			pstmt.executeUpdate();
			System.out.println("실행성공");
		} catch (SQLException ee) {
			System.err.println("Query 실행 클래스 생성 에러~!! : " + ee.toString());
		}		
		dbClose();//디비작업끝나서 닫기
			
	}
	
	void dbCon()
	{
		////////////////////////////////////////
		///데이타베이스접속..	
		try {	Class.forName("org.gjt.mm.mysql.Driver");
		} catch (ClassNotFoundException ee) {System.exit(0);}	

		try {
			conn = DriverManager.getConnection(url, id, pass);
			stmt = conn.createStatement();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
		////////////////////////////////////////////
	}
	void dbClose()
	{		
		// Close 작업
		try {
			
			pstmt.close();
			if (conn != null) {
				if (!conn.isClosed()) {
					conn.close();
				}
				conn = null;
			}
		} catch (SQLException ee) {
			System.err.println("닫기 실패~!!");
		}
	}
	
}