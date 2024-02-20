package project.query;

import java.util.List;

public interface Table {
    
    /**
     * @return columns' names
     */
    List<String> getColumnsName();

    /**
     * @return all table's records
     */
    List<List<String>> getRecords();

    /**
     * @param index is the index of the record
     * @return the record at the specified index
     */
    List<String> getRecord(int index);
}
