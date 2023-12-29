package com.springboot.restfullwebservice.Enitity;


import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;

@Entity
@Table(name = "surat")
public class Surat {
	@Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;   
    @ManyToOne
    @JoinColumn(name = "id_users")
    private User user;
 	@Column(name = "topic")
    private String topic;
 	@Column(name = "keterangan_surat")
    private String keterangan_surat;
 	@Column(name = "nama_surat")
    private String nama_surat;
 	@Column(name="status")
 	private String status;

 	
 	
 	//constructor
 	public Surat() {}
	public Surat(Long id, User user, String topic, String keterangan_surat, String nama_surat, String status) {
		super();
		this.id = id;
		this.user = user;
		this.topic = topic;
		this.keterangan_surat = keterangan_surat;
		this.nama_surat = nama_surat;
		this.status = status;
	}
 	//getter setter



	public Long getId() {
		return id;
	}



	public void setId(Long id) {
		this.id = id;
	}



	public User getUser() {
		return user;
	}



	public void setUser(User user) {
		this.user = user;
	}



	public String getTopic() {
		return topic;
	}



	public void setTopic(String topic) {
		this.topic = topic;
	}



	public String getKeterangan_surat() {
		return keterangan_surat;
	}



	public void setKeterangan_surat(String keterangan_surat) {
		this.keterangan_surat = keterangan_surat;
	}



	public String getNama_surat() {
		return nama_surat;
	}



	public void setNama_surat(String nama_surat) {
		this.nama_surat = nama_surat;
	}



	public String getStatus() {
		return status;
	}



	public void setStatus(String status) {
		this.status = status;
	}
	
 	
 	
}
