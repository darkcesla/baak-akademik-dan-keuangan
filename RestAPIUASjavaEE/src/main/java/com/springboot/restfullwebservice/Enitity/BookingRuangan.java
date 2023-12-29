package com.springboot.restfullwebservice.Enitity;

import java.time.LocalDateTime;
import java.util.Date;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;

@Entity
@Table(name = "booking_ruangan")

public class BookingRuangan {
		@Id
	    @GeneratedValue(strategy = GenerationType.IDENTITY)
	    private Long id;
	    @ManyToOne
	    @JoinColumn(name = "id_ruangan")
	    private Ruangan ruangan;
	    @ManyToOne
	    @JoinColumn(name = "id_users")
	    private User user;
	 	@Column(name = "start_booking")
	    private LocalDateTime odate;
	 	@Column(name = "close_booking")
	    private LocalDateTime cdate;
	 	@Column(name="status")
	 	private String status;
	 	@Column(name="keterangan")
	 	private String keperluan;
	 	
	 	//contructor
	 	public BookingRuangan() {}
	 	
		public BookingRuangan(Long id, Ruangan ruangan, User user, LocalDateTime odate, 
				LocalDateTime cdate,String status,String keperluan) {
			super();
			this.id = id;
			this.ruangan = ruangan;
			this.user = user;
			this.odate = odate;
			this.cdate = cdate;
			this.status = status;
			this.keperluan = keperluan;
		}

		// getter setter 
		
		public Long getId() {
			return id;
		}
		public String getKeperluan() {
			return keperluan;
		}

		public void setKeperluan(String keperluan) {
			this.keperluan = keperluan;
		}

		public String getStatus() {
			return status;
		}

		public void setStatus(String status) {
			this.status = status;
		}

		public void setId(Long id) {
			this.id = id;
		}
		public Ruangan getRuangan() {
			return ruangan;
		}
		public void setRuangan(Ruangan ruangan) {
			this.ruangan = ruangan;
		}
		public User getUser() {
			return user;
		}
		public void setUser(User user) {
			this.user = user;
		}




		public LocalDateTime getOdate() {
			return odate;
		}




		public void setOdate(LocalDateTime odate) {
			this.odate = odate;
		}




		public LocalDateTime getCdate() {
			return cdate;
		}




		public void setCdate(LocalDateTime cdate) {
			this.cdate = cdate;
		}

	 	
	 	
}
