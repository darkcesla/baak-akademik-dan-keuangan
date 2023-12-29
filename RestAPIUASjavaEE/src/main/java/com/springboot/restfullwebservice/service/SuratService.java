package com.springboot.restfullwebservice.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.springboot.restfullwebservice.Enitity.Surat;
import com.springboot.restfullwebservice.repository.SuratRepository;

import java.util.List;

@Service
public class SuratService {
	
	  @Autowired
	    private SuratRepository SuratRepository;
	  
    public Surat createSurat(Surat Surat) {
        	Surat.setStatus("Pending");
            return SuratRepository.save(Surat);

    }

    public List<Surat> getAllSurat() {
        return SuratRepository.findAll();
    }
    public List<Surat> getSuratByUser(Long userId) {
        return SuratRepository.findByUserId(userId);
    }

    public Surat getSuratById(Long id) {
        return SuratRepository.findById(id).orElse(null);
    }

    public void deleteSuratById(Long id) {
        SuratRepository.deleteById(id);
    }

    public Surat updateSurat(Long id, Surat updatedSurat) {
        Surat existingSurat = SuratRepository.findById(id).orElse(null);

        if (existingSurat != null) {
                existingSurat.setKeterangan_surat(updatedSurat.getKeterangan_surat());
                existingSurat.setStatus(updatedSurat.getStatus());
                existingSurat.setNama_surat(updatedSurat.getNama_surat());
                existingSurat.setTopic(updatedSurat.getTopic());
                return SuratRepository.save(existingSurat);
            } 
        else {
            return null;
        }
     
    }
    public Surat changeStatus(Long id, Surat updatedSurat) {
    	 Surat existingSurat = SuratRepository.findById(id).orElse(null);

         if (existingSurat != null) {
                 existingSurat.setStatus(updatedSurat.getStatus());
                 existingSurat.setNama_surat(updatedSurat.getNama_surat());
                 return SuratRepository.save(existingSurat);
             } 
         else {
             return null;
         }
    }
   
}
